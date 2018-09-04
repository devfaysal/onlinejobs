<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Session;
use Image; /* https://github.com/Intervention/image */
use Storage;
use App\Religion;
use App\Country;
use App\Language;
use App\SkillLevel;
use App\MaritalStatus;
use App\Gender;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();
        $profile = $user->profile;
        if($user->hasRole('professional')){
            return view('profile.professional.show', compact('profile'));
        }elseif($user->hasRole('worker')){
            return view('profile.worker.show', compact('profile'));
        }elseif($user->hasRole('maid')){
            return view('profile.maid.show', compact('profile'));
        };
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = auth()->user();
        if($user->profile->id != $id){
            die();
        }
        $profile = $user->profile;
        $religions = Religion::where('status', '=', 1)->get();
        $nationalitys = Country::where('status', '=', 1)->get();
        $languages = Language::where('status', '=', 1)->get();
        $skill_levels = SkillLevel::where('status', '=', 1)->get();
        $marital_statuses = MaritalStatus::where('status', '=', 1)->get();
        $genders = Gender::where('status', '=', 1)->get();

        if($user->hasRole('professional')){
            return view('profile.professional.edit', compact('profile','religions','nationalitys','languages','skill_levels','marital_statuses','genders'));
        }elseif($user->hasRole('worker')){
            return view('profile.worker.edit', compact('profile','religions','nationalitys','languages','skill_levels','marital_statuses','genders'));
        }elseif($user->hasRole('maid')){
            return view('profile.maid.edit', compact('profile','religions','nationalitys','languages','skill_levels','marital_statuses','genders'));
        };
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = auth()->user();
        $profile = $user->profile;
        if($user->profile->id != $id){
            die();
        }

        if($request->file('image')){
            $this->validate($request, [
                'image' => 'image|max:250',
            ]);
            
            $image_basename = explode('.',$request->file('image')->getClientOriginalName())[0];
            $image = $image_basename . '-' . time() . '.' . $request->file('image')->getClientOriginalExtension();

            $img = Image::make($request->file('image')->getRealPath());
            $img->stream();

            //Upload image
            Storage::disk('local')->put('public/'.$image, $img);

            //Remove if there was any old image
            if($profile->image != ''){
                Storage::disk('local')->delete('public/'.$profile->image);
            }

            //add new image path to database
            $profile->image = $image;
            
        }

        if($request->file('full_image')){
            $this->validate($request, [
                'full_image' => 'image|max:250',
            ]);
            
            $image_basename = explode('.',$request->file('full_image')->getClientOriginalName())[0];
            $image = $image_basename . '-' . time() . '.' . $request->file('full_image')->getClientOriginalExtension();

            $img = Image::make($request->file('full_image')->getRealPath());
            $img->stream();

            //Upload image
            Storage::disk('local')->put('public/'.$image, $img);

            //Remove if there was any old image
            if($profile->full_image != ''){
                Storage::disk('local')->delete('public/'.$profile->full_image);
            }

            //add new image path to database
            $profile->full_image = $image;
            
        }


        $profile->name = $request->name;
        $profile->phone = $request->phone;
        $profile->gender = $request->gender;
        $profile->date_of_birth = $request->date_of_birth;
        $profile->nationality = $request->nationality;
        $profile->religion = $request->religion;
        $profile->native_language = $request->native_language;
        $profile->other_languages = $request->other_languages;
        $profile->marital_status = $request->marital_status;
        $profile->height = $request->height;
        $profile->weight = $request->weight;
        $profile->highest_education = $request->highest_education;
        $profile->skill_level = $request->skill_level;
        $profile->work_on_off_days_with_compensation = $request->work_on_off_days_with_compensation;
        $profile->able_to_handle_pork = $request->able_to_handle_pork;
        $profile->able_to_gardening = $request->able_to_gardening;
        $profile->able_to_care_dog_cat = $request->able_to_care_dog_cat;
        $profile->able_to_simple_sewing = $request->able_to_simple_sewing;
        $profile->able_to_wash_car = $request->able_to_wash_car;
        $profile->able_to_eat_pork = $request->able_to_eat_pork;
        $profile->able_to_care_infants = $request->able_to_care_infants;
        $profile->able_to_care_elderly = $request->able_to_care_elderly;
        $profile->able_to_care_disabled = $request->able_to_care_disabled;
        $profile->able_to_do_general_housework = $request->able_to_do_general_housework;
        $profile->able_to_cook = $request->able_to_cook;

        $profile->save();

        Session::flash('message', 'Information saved successfully!'); 
        Session::flash('alert-class', 'alert-success');

        return redirect()->route('profile.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    public function public($public)
    {
        $user = User::where('public_id', '=', $public)->first();

        $profile = $user->profile;
        if($user->hasRole('professional')){
            return view('profile.professional.show', compact('profile'));
        }elseif($user->hasRole('worker')){
            return view('profile.worker.show', compact('profile'));
        }elseif($user->hasRole('maid')){
            return view('profile.maid.show', compact('profile'));
        };
    }
}
