<?php

namespace App\Models;



class Listing
{
	public static function all()
	{
		return  [
			[
				'id' => 1,
				'title' => 'title 1',
				'content' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Rem ipsum quasi eius molestias itaque impedit? Rem at quo veniam accusantium nam est, quasi sunt optio repudiandae inventore adipisci qui quam.'
			],
			[
				'id' => 2,
				'title' => 'title 2',
				'content' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Rem ipsum quasi eius molestias itaque impedit? Rem at quo veniam accusantium nam est, quasi sunt optio repudiandae inventore adipisci qui quam.'
			],
			[
				'id' => 3,
				'title' => 'title 3',
				'content' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Rem ipsum quasi eius molestias itaque impedit? Rem at quo veniam accusantium nam est, quasi sunt optio repudiandae inventore adipisci qui quam.'
			],

		];
	}
    public static function find($id){
        $listings = self::all();
        $output = null;

        foreach ($listings as $listing) {
            if($listing['id']==$id){
                $output=$listing;
                return $output;
            }
        }
        return $output;
    }
}
