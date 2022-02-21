<?php

namespace App\Http\Resources;
use App\SearchProfile;
use Illuminate\Http\Resources\Json\JsonResource;

class Property extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $searchProfiles = SearchProfile::all();
        $scoring_match =  array();
        $missmatch =0;

        foreach ($searchProfiles as $searchProfile) {
            $missmatch=0;
            $score=0;
            $strictMatchesCount=0;
            $looseMatchesCount=0;
            if($this->propertyType != $searchProfile->propertyType) {
                $missmatch=1;
                continue;
            }
            else {
                $propertyfields = json_decode($this->fields);
                $searchProfilefields = json_decode($searchProfile->searchFields);
                foreach($propertyfields as $pf => $pf_val){
                    foreach($searchProfilefields as $sf => $sf_val){
                        if($pf==$sf){
                            
                            if(is_array($sf_val)){
                                
                                if($pf_val >= $sf_val[0] and $pf_val <= $sf_val[1]){
                                    $score=$score+3;
                                    $strictMatchesCount=$strictMatchesCount+1;
                                }
                                else{
                                    if($pf_val >= $sf_val[0]-(0.25*$sf_val[0]) and $pf_val <= $sf_val[1]+(0.25*$sf_val[1])){
                                        $score=$score+1;
                                        $looseMatchesCount=$looseMatchesCount+1;
                                    }
                                    else{
                                        if(is_null($sf_val[0])){
                                            if($pf_val <= $sf_val[1]){
                                                $score=$score+3;
                                                $strictMatchesCount=$strictMatchesCount+1;
                                            }
                                            else{
                                                if($pf_val <= $sf_val[1]+(0.25*$sf_val[1])){
                                                    $score=$score+1;
                                                    $looseMatchesCount=$looseMatchesCount+1;
                                                }
                                                else{
                                                    $missmatch=1;
                                                    continue;
                                                }
                                            }
                                        }
                                        else{
                                            if(is_null($sf_val[1])){
                                                if($pf_val >= $sf_val[0]){
                                                    $score=$score+3;
                                                    $strictMatchesCount=$strictMatchesCount+1;
                                                }
                                                else{
                                                    if($pf_val >= $sf_val[0]-(0.25*$sf_val[0])){
                                                        $score=$score+1;
                                                        $looseMatchesCount=$looseMatchesCount+1;
                                                    }
                                                    else{
                                                        $missmatch=1;
                                                        continue;
                                                    }
                                                }
                                            }
                                            else{
                                                $missmatch=1;
                                                continue;    
                                            }
                                            
                                        }
                                        
                                    }
                                }
                            }
                            else{
                                if($pf_val == $sf_val or is_null($sf_val)){
                                    $score=$score+3;
                                    $strictMatchesCount=$strictMatchesCount+1;
                                }
                                else{
                                    $missmatch=1;
                                    continue;
                                }
                            }
                        }
                    }
                }
                if($missmatch==0){
                    $scoring_match[] = array("searchProfileId"=>$searchProfile->id,"score"=>$score,"strictMatchesCount"=>$strictMatchesCount,"looseMatchesCount"=>$looseMatchesCount);
                }
            }
        }
        $keys = array_column($scoring_match, 'score');

		array_multisort($keys, SORT_DESC, $scoring_match);
        return $scoring_match;
    }
}
