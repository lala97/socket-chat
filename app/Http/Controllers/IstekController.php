<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Session;
use Auth;
use App\Elan;
use App\Photo;
class IstekController extends Controller
{
  //<================= METHHOD FOR SHOW PAGE ================>
    public function show()
    {
      return view('pages.istek_add');
    }

  //<================= METHHOD FOR ISTEK_ADD PAGE ================>

    public function imageType($name)
    {
      $file_type = strtolower($name->getClientOriginalExtension());
      if($file_type =='jpg' || $file_type =='jpeg' || $file_type =='png'){

        if($name->getRealPath() && !@is_array(getimagesize($name->getRealPath()))){
          return false;
        }else{
          return true;
        }
      }else{
        return false;
      }
    }

    public function istek_add(Request $req)
    {
       // $tarix = date('Y-m-d');
       // if(date_create($req->date) < date_create($tarix)){
       //   Session::flash('dateerror' , "Zəhmət olmasa tarixi düzgün seçin.");
       //   return back();
       // }

      if($req->file('image')[0]==null){
       Session::flash('imageerror' , "Xahiş olunur şəkil seçin.");
       return back();
     }
         $this->validate($req, [
             'title' => 'required',
             'about' => 'required',
             'location' =>'required',
             'lat' => 'required',
             'lng' => 'required',
             'name' => 'required',
             'phone' => 'required',
             'email' => 'required',
             'nov' => 'required',
             'date' => 'required|after:tomorrow'
        ]);


     $files = $req->file('image');
     $pic_name = array();

     foreach ($files as $file) {
      $check = $this->imageType($file);

        if ($check==true) {
          continue;
        }else{
          Session::flash('imageerror' , "Xahiş düzgün şəkil seçin.");
             return redirect('/istek-add');
        }
      }
              $data = [
               'type_id'=>'2',
               'title'=>$req->title,
               'about'=>$req->about,
               'location'=>$req->location,
               'lat'=>$req->lat,
               'lng'=>$req->lng,
               'name'=>$req->name,
               'phone'=>'+994'.$req->operator.$req->phone,
               'email'=>$req->email,
               'org'=>$req->org,
               'nov'=>$req->nov,
               'deadline'=>$req->date
             ];
          $insert_pic_id = Auth::user()->elanlar()->create($data)->shekiller();
          $files = $req->file('image');

          foreach ($files as $file) {
            $file_name =  date('ygmis').'.'.$file->getClientOriginalName();
            $file->move(public_path('image'),$file_name);
            $data = new Photo;
            $data->imageName = $file_name;
            $insert_pic_id->save($data);
           }
         Session::flash('istekadded' , "İstəyiniz uğurla  əlavə olundu və yoxlamadan keçəndən sonra dərc olunacaq.");
           return redirect('/istek-add');

  }


  //<================= METHHOD FOR ISTEK_EDIT ================>
  public function istek_edit($id)
  {

    $istek_edit = Elan::find($id);
    if ($istek_edit) {
    if($istek_edit->user_id==Auth::user()->id){
        return view('pages.istek_edit',compact('istek_edit'));
      }else {
        return view('errors.503');
      }
    }else{
      return view('errors.503');
    }
  }

  //<================= METHHOD FOR SAVING IMG WITH AJAX ================>

   public function only_pic(Request $req)
        {

          if ($req->ajax()) {

          if($req->imgLength>5){
            return false;
          }

            $file_type = $req->file->getClientOriginalExtension();
            $lowered = strtolower($file_type);

            $check = $this->imageType($req->file);

            if ($check==true) {
               $fileName = $req->file->getClientOriginalName();
                $file = $_FILES['file'];
                $istek_id = $_POST['istek_id'];
                $file['istek_id'] = $istek_id;
                $file_name =date('ygmis').'.'.$fileName;
                $req->file->move(public_path('image'), $file_name);
                $sekil = Elan::find($istek_id);
                $hamsi = $sekil->shekiller();
                $data = new Photo;
                $data->imageName = $file_name;
                $hamsi->save($data);
                return json_encode($file_name);
            }else{
                 $file_name="error";
                 return json_encode($file_name);
            }
          }

        }

  //<============ METHHOD FOR DELETING X PRESSED IMGS FROM EDITING=======>


      public function deleteAjax(Request $req)
      {
        if($req->ajax()){
          $name = $_POST['imagefile'];
          $he = Photo::where('imageName',$name);
          echo $he->count();
          $im_length = $_POST['im_length'];
          if($he->count()==1 && $im_length==1){
            $img_error = "olmaz";
            return json_encode($img_error);
          }else{
            if(file_exists('image/'.$name)){
                  unlink('image/'.$name);
                  $he->delete();
              }
          }
        }
      }
  //<============ METHHOD FOR DELETING X PRESSED IMGS WITH AJAX=======>



  //<================= METHHOD FOR ISTEK_EDIT ================>
  public function istek_update(Request $req,$id)
  {
        $this->validate($req, [
            'title' => 'required',
            'about' => 'required',
            'location' => 'required',
            'lat' => 'required',
            'lng' => 'required',
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'nov' => 'required',
            'date' => 'required|after:tomorrow'
      ]);

        // $this->delete_edited_pics($req->input('picsArray'));

       Session::flash('istek_edited' , "İstəyiniz uğurla dəyişdirildi və yoxlamadan keçəndən sonra dərc olunacaq.");
       $istek_update = Elan::find($id);
       if ($istek_update) {
         $istek_update->title = $req->title;
         $istek_update->location = $req->location;
         $istek_update->lat = $req->lat;
         $istek_update->lng = $req->lng;
         $istek_update->about = $req->about;
         $istek_update->name = $req->name;
         $istek_update->email = $req->email;
         $istek_update->org = $req->org;
         $istek_update->nov = $req->nov;
         $istek_update->deadline = $req->date;
         $istek_update->phone = $req->phone;
         $istek_update->status = 0;
         $istek_update->update();
         return redirect("/istek-edit/$istek_update->id");
       }else {
         return view('errors.503');
       }
  }


  //<================= METHHOD FOR ISTEK_EDIT ================>
   public function istek_delete($id)//updated
   {
     $istek_delete=Elan::find($id);
   if ($istek_delete) {
    if($istek_delete->user_id==Auth::user()->id){
       $istek_delete->shekiller();
       foreach ($istek_delete->shekiller as $val) {
         unlink('image/'.$val->imageName);
       }
       $istek_delete->delete();
       return back();
     }else {
       return view('errors.503');
     }
   }else {
     return view('errors.503');
   }
 }
}
