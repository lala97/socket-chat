<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Auth;
use App\Elan;
use App\Photo;
use Session;
class DestekController extends Controller
{
  public function show()
  {
    return view('pages.destek_add');
  }


////////////////////////////////checking uploaded file

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

  public function destek_add(Request $req)
  {
     if($req->file('image')[0]==null){
       Session::flash('imageerror' , "Xahiş olunur şəkil seçin.");
          return back();
      }
       // $tarix = date('Y-m-d');
       // if(date_create($req->date) < date_create($tarix)){
       //   Session::flash('dateerror' , "Zəhmət olmasa tarixi düzgün seçin.");
       //   return back();    
       // }

        $this->validate($req, [
          'title' => 'required',
          'about' => 'required',
          'location' => 'required',
          'lat' => 'required',
          'lng' => 'required',
          'image'=> 'required',
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
             return redirect('/destek-add');
        }
      }

    $data = [
          'type_id'=>'1',
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
      Session::flash('destek_add' , "Dəstəyiniz uğurla  əlavə olundu və yoxlamadan keçəndən sonra dərc olunacaq.");
       return redirect('/destek-add');
  }

  public function destek_edit($id)
  {
    $destek_edit = Elan::find($id);
    if ($destek_edit) {
    if($destek_edit->user_id==Auth::user()->id){
        return view('pages.destek_edit',compact('destek_edit'));
      }else {
        return view('errors.503');
      }
    }else {
      return view('errors.503');
    }
  }

  public function destek_update(Request $req,$id)
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
        'nov' => 'required'
    ]);

    // $this->delete_edited_pics($req->input('picsArray'));

   Session::flash('destek_edited' , "Dəstəyiniz uğurla dəyişdirildi və yoxlamadan keçəndən sonra dərc olunacaq.");
   $destek_update = Elan::find($id);
   $destek_update->title = $req->title;
   $destek_update->location = $req->location;
   $destek_update->lat = $req->lat;
   $destek_update->lng = $req->lng;
   $destek_update->about = $req->about;
   $destek_update->name = $req->name;
   $destek_update->email = $req->email;
   $destek_update->org = $req->org;
   $destek_update->nov = $req->nov;
   $destek_update->deadline = $req->date;
   $destek_update->phone = $req->phone;
   $destek_update->status = 0;
   $destek_update->update();
   return redirect("/destek-edit/$destek_update->id");
  }


  //<================= METHHOD FOR ISTEK_EDIT ================>
   // public function destek_delete($id)//updated
   // {
   //   $destek_delete=Elan::find($id);
   //   $destek_delete->shekiller();
   //   foreach ($destek_delete->shekiller as $val) {
   //       unlink('image/'.$val->imageName);
   //   }
   //   $destek_delete->delete();
   //   return back();
   // }
}
