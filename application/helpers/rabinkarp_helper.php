<?php
function parser($answer)
	{
		foreach ($answer as $key => $value) 
		{
			$parser[] = strtolower(preg_replace('/[^a-zA-Z ]/', '',$value));
		}
		return $parser;
	}
//$stopword = menghilankan kata hubung.contoh = dan, dengan, yang, atau
	function filter($parser, $stopword)
	{
		foreach ($parser as $key => $value) 
		{
			$filter[] = preg_replace('/\b('.implode('|',$stopword).')\b/','',$value);
		}
		return $filter;
	}
//steming = merubah kebentuk kata dasar
	function steamming($filter)
	{

		foreach ($filter as $key => $value) 
		{
			$stm[] = str_word_count($value, 1);
		}

		foreach ($stm as $key => $value) 
		{
			foreach ($value as $key1 => $value1) 
			{
				$stmm[$key][]= hapusakhiran(hapusawalan2(hapusawalan1(hapuspp(hapuspartikel($value1))))); 
			}
		}

		foreach ($stmm as $key => $value) 
		{
			$steamming[]= implode(' ', $value); 
		}
		return $steamming;
	}

	function no_space($steamming)
	{
		foreach ($steamming as $key => $value) 
		{
			$no_space[] = preg_replace('/\s+/', '', $value);
		}
		return $no_space;
	}

	function kgram_2($no_space)
	{
		for($i = 0; $i < count($no_space); $i++)
		{
		$kgram_2[$i] = array();				    
			for($j = 0; $j < (strlen($no_space[$i]) - 1); $j++)
			{	
			   $kgram_2[$i][] = substr($no_space[$i], $j, 2);
			}
		}
		return $kgram_2;
	}

	function change_to_ascii_indek_0($kgram_2)
	{
		$change_to_ascii_indek_0 = array();
			foreach ($kgram_2 as $key => $value) 
			{
				foreach ($value as $key1 => $value1) 
				{
					$change_to_ascii_indek_0[$key][] = ord($value1[0])*10;
				}
			}
		return $change_to_ascii_indek_0;
	}

	function change_to_ascii_indek_1($kgram_2)
	{
		$change_to_ascii_indek_1 = array();
			foreach ($kgram_2 as $key => $value) 
			{
				foreach ($value as $key1 => $value1) 
				{
					$change_to_ascii_indek_1[$key][] = ord($value1[1])*1;
				}
			}
		return $change_to_ascii_indek_1;
	}

	function plus_indek_0_and_indek_1($no_space, $change_to_ascii_indek_0, $change_to_ascii_indek_1)
	{
		$plus_indek_0_and_indek_1 = array();
			for($i = 0; $i < count($no_space); $i++)
			{
				for($j = 0; $j < (strlen($no_space[$i]) -1); $j++) 
				{
			  		$plus_indek_0_and_indek_1[$i][$j] = $change_to_ascii_indek_0[$i][$j] + $change_to_ascii_indek_1[$i][$j];
			  	}
			}
		return $plus_indek_0_and_indek_1;
	}
	//membandingkan jawaban user dengan system
	function count_same_value($plus_indek_0_and_indek_1_user, $plus_indek_0_and_indek_1_system)
	{
		$count_same_value = array();
			foreach ($plus_indek_0_and_indek_1_system as $key => $value) 
			{
				$count_same_value[] = count(array_intersect($value, $plus_indek_0_and_indek_1_user[$key]));
			}
		return $count_same_value;
	}

	function sum_array($no_space_user, $no_space_system, $plus_indek_0_and_indek_1_user, $plus_indek_0_and_indek_1_system)
	{
		$sum_array_user = array();
			for($i = 0; $i < count($no_space_user); $i++)
			{
				for($j = 0; $j < (strlen($no_space_user[$i]) -1); $j++) 
				{
					$sum_array_user[$i] = count($plus_indek_0_and_indek_1_user[$i]);
				}
			}

		$sum_array_system = array();
			for($i = 0; $i < count($no_space_system); $i++)
			{
				for($j = 0; $j < (strlen($no_space_system[$i]) -1); $j++) 
				{
					$sum_array_system[$i] = count($plus_indek_0_and_indek_1_system[$i]);
				}
			}
	
		$sum_array = array();
			foreach ($sum_array_system as $key => $value) 
			{
				$count_rkr[] = $value + $sum_array_user[$key];
			}

		return $sum_array;
	}

	function textSimilarity($count_same_value, $sum_array)
	{
		$textSimilarity = array();
			foreach ($sum_array as $key => $value) 
			{
				$textSimilarity[] = 2*$count_same_value[$key] / $value;
			}
		return $textSimilarity;
	}
//------------Stemming----------------
		function cari($kata)
		{
			$ci = & get_instance();
			$ci->load->model('User_model');
			$kata = $ci->User_model->get_katadasar($kata);

			return $kata;
		}
		//langkah 1 - hapus partikel
		function hapuspartikel($kata)
		{
			if(cari($kata)!=1)
			{
				if((substr($kata, -3) == 'kah' )||
				   (substr($kata, -3) == 'lah' )||
				   (substr($kata, -3) == 'pun' ))
				{
					$kata = substr($kata, 0, -3);			
				}
			}
			return $kata;
		}

		//langkah 2 - hapus possesive pronoun
		function hapuspp($kata)
		{
			if(cari($kata)!=1)
			{
				if(strlen($kata) > 4)
				{
					if((substr($kata, -2)== 'ku')||(substr($kata, -2)== 'mu'))
					{
						$kata = substr($kata, 0, -2);
					}
					else if((substr($kata, -3)== 'nya'))
					{
						$kata = substr($kata,0, -3);
					}
			  	}
			}
			return $kata;
		}

		//langkah 3 hapus first order prefiks (awalan pertama)
		function hapusawalan1($kata)
		{
			if(cari($kata)!=1)
			{
				if(substr($kata,0,4)=="meng")
				{
					if(substr($kata,4,1)=="e"||substr($kata,4,1)=="u")
					{
						$kata = "k".substr($kata,4);
					}
					else
					{
						$kata = substr($kata,4);
					}
				}
				else if(substr($kata,0,4)=="meny")
				{
					$kata = "s".substr($kata,4);
				}
				else if(substr($kata,0,3)=="men")
				{
					$kata = substr($kata,3);
				}
				else if(substr($kata,0,3)=="mem")
				{
					if(substr($kata,3,1)=="a" || 
					   substr($kata,3,1)=="i" || 
					   substr($kata,3,1)=="e" || 
					   substr($kata,3,1)=="u" || 
					   substr($kata,3,1)=="o")
					{
						$kata = "p".substr($kata,3);
					}
					else
					{
						$kata = substr($kata,3);
					}
				}
				else if(substr($kata,0,2)=="me")
				{
					$kata = substr($kata,2);
				}
				else if(substr($kata,0,4)=="peng")
				{
					if(substr($kata,4,1)=="e" || 
					   substr($kata,4,1)=="a")
					{
						$kata = "k".substr($kata,4);
					}
					else
					{
						$kata = substr($kata,4);
					}
				}
				else if(substr($kata,0,4)=="peny")
				{
					$kata = "s".substr($kata,4);
				}
				else if(substr($kata,0,3)=="pen")
				{
					if(substr($kata,3,1)=="a" || 
					   substr($kata,3,1)=="i" || 
					   substr($kata,3,1)=="e" || 
					   substr($kata,3,1)=="u" || 
					   substr($kata,3,1)=="o")
					{
						$kata = "t".substr($kata,3);
					}
					else
					{
						$kata = substr($kata,3);
					}
				}
				else if(substr($kata,0,3)=="pem")
				{
					if(substr($kata,3,1)=="a" || 
					   substr($kata,3,1)=="i" || 
					   substr($kata,3,1)=="e" || 
					   substr($kata,3,1)=="u" || 
					   substr($kata,3,1)=="o")
					{
						$kata = "p".substr($kata,3);
					}
					else
					{
						$kata = substr($kata,3);
					}
				}
				else if(substr($kata,0,2)=="di")
				{
					$kata = substr($kata,2);
				}
				else if(substr($kata,0,3)=="ter")
				{
					$kata = substr($kata,3);
				}
				else if(substr($kata,0,2)=="ke")
				{
					$kata = substr($kata,2);
				}
			}
			return $kata;
		}
		//langkah 4 hapus second order prefiks (awalan kedua)
		function hapusawalan2($kata)
		{
			if(cari($kata)!=1)
			{  
				if(substr($kata,0,3)=="ber")
				{
					$kata = substr($kata,3);
				}
				else if(substr($kata,0,3)=="bel")
				{
					$kata = substr($kata,3);
				}
				else if(substr($kata,0,2)=="be")
				{
					$kata = substr($kata,2);
				}
				else if(substr($kata,0,3)=="per" && strlen($kata) > 5)
				{
					$kata = substr($kata,3);
				}
				else if(substr($kata,0,2)=="pe"  && strlen($kata) > 5)
				{
					$kata = substr($kata,2);
				}
				else if(substr($kata,0,3)=="pel"  && strlen($kata) > 5)
				{
					$kata = substr($kata,3);
				}
				else if(substr($kata,0,2)=="se"  && strlen($kata) > 5)
				{
					$kata = substr($kata,2);
				}
			}
			return $kata;
		}
		////langkah 5 hapus suffiks
		function hapusakhiran($kata)
		{
			if(cari($kata)!=1)
			{
				if (substr($kata, -3)== "kan" )
				{
					$kata = substr($kata, 0, -3);
				}
				else if(substr($kata, -1)== "i" )
				{
				    $kata = substr($kata, 0, -1);
				}
				else if(substr($kata, -2)== "an")
				{
					$kata = substr($kata, 0, -2);
				}
			}	
			return $kata;
		}
?>