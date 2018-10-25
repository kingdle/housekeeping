<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Girl extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $hyphenated = array('欧阳','太史','端木','上官','司马','东方','独孤','南宫','万俟','闻人','夏侯','诸葛','尉迟','公羊','赫连','澹台','皇甫',
            '宗政','濮阳','公冶','太叔','申屠','公孙','慕容','仲孙','钟离','长孙','宇文','城池','司徒','鲜于','司空','汝嫣','闾丘','子车','亓官',
            '司寇','巫马','公西','颛孙','壤驷','公良','漆雕','乐正','宰父','谷梁','拓跋','夹谷','轩辕','令狐','段干','百里','呼延','东郭','南门',
            '羊舌','微生','公户','公玉','公仪','梁丘','公仲','公上','公门','公山','公坚','左丘','公伯','西门','公祖','第五','公乘','贯丘','公皙',
            '南荣','东里','东宫','仲长','子书','子桑','即墨','达奚','褚师');
        $vLength = mb_strlen($this->username, 'utf-8');
        $lastname = '';
        $firstname = '';//前为姓,后为名
        if($vLength > 2){
            $preTwoWords = mb_substr($this->username, 0, 2, 'utf-8');//取命名的前两个字,看是否在复姓库中
            if(in_array($preTwoWords, $hyphenated)){
                $lastname = $preTwoWords;
                $firstname = mb_substr($this->username, 2, 10, 'utf-8');
                if($this->user->gender=='1'){
                    $namecall=$lastname.'叔叔';
                }else{
                    $namecall=$lastname.'阿姨';
                }
            }else{
                $lastname = mb_substr($this->username, 0, 1, 'utf-8');
                $firstname = mb_substr($this->username, 1, 10, 'utf-8');
                if($this->user->gender=='1'){
                    $namecall=$lastname.'叔叔';
                }else{
                    $namecall=$lastname.'阿姨';
                }
            }
        }else if($vLength == 2){//全名只有两个字时,以前一个为姓,后一下为名
            $lastname = mb_substr($this->username ,0, 1, 'utf-8');
            if($this->user->gender=='1'){
                $namecall=$lastname.'叔叔';
            }else{
                $namecall=$lastname.'阿姨';
            }
            $firstname = mb_substr($this->username, 1, 10, 'utf-8');
        }else{
            $lastname = $this->username;
            $namecall= $this->username;
        }
        return [
            'id'=>$this->id,
            'user_id'=>$this->user_id,
            'user'=>$this->user,
            'product_id'=>$this->product_id,
            'product'=>$this->product,
            'number_id'=>$this->number_id,
            'username'=>$this->username,
            'name_call'=>$namecall,
            'id_card'=>$this->id_card,
            'id_card_front'=>$this->id_card_front,
            'id_card_back'=>$this->id_card_back,
            'real_head'=>$this->real_head,
            'age'=>$this->age,
            'address'=>$this->address,
            'address_name'=>$this->address_name,
            'native_place'=>$this->native_place,
            'latitude'=>$this->latitude,
            'longitude'=>$this->longitude,
            'education_id'=>$this->education_id,
            'education'=>$this->education,
            'health_card'=>$this->health_card,
            'level'=>$this->level,
            'price'=>$this->price,
            'service_times'=>substr($this->service_times,0,10),
            'experience'=>$this->experience,
            'pic_count'=>$this->pic_count,
            'order_count'=>$this->order_count,
            'published_at'=>substr($this->published_at,0,10),
            'code'=>$this->code,
            'close_comment'=>$this->close_comment,
            'is_hidden'=>$this->is_hidden,
            'is_active'=>$this->is_active,
            'created_at'=>$this->created_at->format('Y-m-d H:i'),
            'update_at'=>substr($this->update_at,0,10),
        ];
    }
}
