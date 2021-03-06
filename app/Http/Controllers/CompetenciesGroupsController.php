<?php

namespace App\Http\Controllers;

use App\Models\competenciesGroups;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class CompetenciesGroupsController extends Controller
{
   
    public function index()
    {
        $competencygroups = DB::table('competencies_groups')->orderBy('id', 'asc')->get();
		return view('competencygroups.index', ["competencygroups" => $competencygroups]);
    }   

        public function create_page(){
            return view('competencygroups.add_competencygroups');
        }

        public function create(Request $requests) {              
            $competencygroups =$requests['adjArr'];		//return;
            foreach ($competencygroups as $key=>$value) {
                
                $validator = Validator::make($requests->all(), [
                    'competency_group'=>'unique:competency_group',
                ]);
                if ($validator->fails()) {
                    return redirect('/add-competencygroups')
                        ->withInput()
                        ->withErrors($validator);
                }	
                competenciesGroups::create(['competency_group'=>$value]); 
            }
            return redirect('/add-competencygroups')->with('success', 'Data saved succesfully');
        }

        public function edit(Request $request){
            $id=$request->id;
            $competency_group=$request->competency_group;
           // dd($request);
            competenciesGroups::where('id',$id)->update(['competency_group'=>$competency_group]);
           return redirect('/competencygroups')->with('success',"competency group $competency_group updated successfully");
        }
        public function delete($id){

            $del = competencyGroups::findOrFail($id);
            $del->delete();
            return redirect('competencygroups')->with('success', 'Deleted successfully!');
                
        }
    

    
}
