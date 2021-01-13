<?php

echo ("<h1>1</h1>");
	mycourses(["4242"],"add");
echo ("<h1>2</h1>");
	mycourses(["407"],"remove");
//echo ("<h1>3</h1>");
//mycourses(["407"], "remove");

function sprawdzajWGore(&$p__all_categories_tree,  $p__categories_tree_path, $ileOdjac,$checked){

	$biezaca = &$p__all_categories_tree;

	if ( count($p__categories_tree_path) - $ileOdjac < 0 ){
		return;
	}


	for ($i = 0; $i < count($p__categories_tree_path) - $ileOdjac +1 ; $i++ )  {
		$biezaca = &$biezaca[ $p__categories_tree_path[$i] ];
	}
	
	if ($checked > 0 ) {
	$biezaca["checked"] = 1;
	}else 
	{
		$biezaca["checked"] = 0;
		$checked++ ;
	}

	$biezaca = &$p__all_categories_tree;
	for ($i = 0; $i < count($p__categories_tree_path) - $ileOdjac -1 ; $i++ )  {
		$biezaca = &$biezaca[ $p__categories_tree_path[$i] ];
	}

	if( $biezaca != $p__all_categories_tree) {
			for ($i=0; $i < count($biezaca["children"]); $i++) { 
				if( $biezaca["children"][$i]["checked"] !=1 ){
					return; 	//chociaż jedna różna od zera to przerywa i kończy
				}
			}
		
			$ileOdjac += 2;
			sprawdzajWGore( $p__all_categories_tree , $p__categories_tree_path, $ileOdjac, $checked );
	}

	
}

    function mycourses($checkedIds = ["4242"], $action = "add",$request = 0, $requestTest = false,$zmienna = false)
	{

		//dd($request);
		//$action = "remove";
		
		//dd($action);
		if ($requestTest){
			$req = array();
			$req['inputValue'] = $requestTest ;
			
		}
		else {
		//$checkedIds = ["407"];
		}

		//$checkedIds = ["4242"] ;


		//4242
	
	//    $checkedIds = explode(',', $req['inputValue']);
		/// all tree with course
		//dd($checkedIds);
		if ($zmienna){
		$all_categories_tree = $zmienna ;
		}else {
		$all_categories_tree = getRecurringCategories(0);
		}
		//dnl($all_categories_tree);
		//dd($all_categories_tree);
		// all tree course  checked
		$categories_tree = array();
	// all tree course  path
	//$categories_tree_path = array();
	//$checkedIds 


		//$categories_tree_path = $this->array_search_path("path", $arr);

		foreach ($checkedIds as $indicator => $checkedId) {
			//dd($checkedId);
			if ($checkedId < 1000){
                $categories_tree[$indicator] = [] ;
				$categories_tree[$indicator] = getChildrenFor($all_categories_tree, $checkedId);
            }
            
          //  var_dump($categories_tree[$indicator]);die();
			if ($action == "add" && $checkedId < 1000) {
				array_walk_recursive(
					$categories_tree[$indicator],
					function (&$value, $key) {

						if ($key == 'checked') {
							$value = true;
						}
					}
				);
			}
			//dd($categories_tree[$indicator]);
			if ($action == "remove" && $checkedId < 1000) {
				array_walk_recursive(
					$categories_tree[$indicator],
					function (&$value, $key) {

						if ($key == 'checked') {
							$value = false;
						}
					}
				);
			}

			$categories_tree_path[$indicator] = array_search_path($checkedId, $all_categories_tree);

			//dd($categories_tree_path[$indicator]);

			//dd($categories_tree_path[$indicator]);
			array_pop($categories_tree_path[$indicator]);
			array_push($categories_tree_path[$indicator], "children");

			$output = null;
			foreach (array_reverse($categories_tree_path[$indicator]) as $part) {
				$output = $output ? array($part, $output) : array($part);
			}

			if ($action == "add") {
				$aaa = $categories_tree_path[$indicator] ;



				sprawdzajWGore($all_categories_tree, $categories_tree_path[$indicator], 2,1);


			}
			if ($action == "remove") {

				$categories_tree_path[$indicator];

				$biezaca = array();

				$wartosci1 = $categories_tree_path[$indicator][0];
				$wartosci2 = $categories_tree_path[$indicator][1];

				$all_categories_tree[$wartosci1]["checked"] = false;

				$biezaca = &$all_categories_tree[$wartosci1];
				for ($i = 0; $i < count($categories_tree_path[$indicator]); $i = $i + 2) {

					$biezaca["checked"] = false;


					if (isset($categories_tree_path[$indicator][$i + 2])) {
						$wartosci1 = $categories_tree_path[$indicator][$i + 2];
						$wartosci2 = $categories_tree_path[$indicator][$i + 3];
					}

					//$this->setPath([0,"checked"], $all_categories_tree, false);

					if (isset($categories_tree_path[$indicator][$i + 2]) && isset($biezaca[$wartosci2]) && isset($biezaca[$wartosci2][$wartosci1])) {

						$biezaca = &$biezaca[$wartosci2][$wartosci1];
					}
				}
			}
			if ($checkedId < 1000){
			setPath($categories_tree_path[$indicator], $all_categories_tree, $categories_tree[$indicator]);
			
		}
        }


	//	if (!$requestTest){
	dnl($all_categories_tree);
	//	}



		//	$basket = $all_categories_tree ;
		//	dd($basket);

		//	$this->my_walk_recursive($basket);

	}

    function getRecurringCategories($categoryID = 0, $state = "start")
	{

	$emptyArray = 'a:1:{i:0;a:8:{s:2:"id";i:467;s:4:"name";s:2:"p1";s:15:"parent_category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;s:5:"buyed";i:0;s:8:"category";i:1;s:8:"children";a:3:{i:0;a:8:{s:2:"id";i:407;s:4:"name";s:4:"p1.1";s:15:"parent_category";i:467;s:7:"checked";i:0;s:13:"folderChecked";i:0;s:5:"buyed";i:0;s:8:"category";i:1;s:8:"children";a:3:{i:0;a:8:{s:2:"id";i:408;s:4:"name";s:6:"p1.1.1";s:15:"parent_category";i:407;s:7:"checked";i:0;s:13:"folderChecked";i:0;s:5:"buyed";i:0;s:8:"category";i:1;s:8:"children";a:3:{i:0;a:6:{s:4:"name";s:12:"p1.1.1.kurs1";s:2:"id";i:4242;s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;s:15:"parent_category";i:408;}i:1;a:6:{s:4:"name";s:12:"p1.1.1.kurs2";s:2:"id";i:4245;s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;s:15:"parent_category";i:408;}i:2;a:6:{s:4:"name";s:12:"p1.1.1.kurs3";s:2:"id";i:5846;s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;s:15:"parent_category";i:408;}}}i:1;a:8:{s:2:"id";i:415;s:4:"name";s:6:"p1.1.2";s:15:"parent_category";i:407;s:7:"checked";i:0;s:13:"folderChecked";i:0;s:5:"buyed";i:0;s:8:"category";i:1;s:8:"children";a:3:{i:0;a:6:{s:4:"name";s:12:"p1.1.2.kurs1";s:2:"id";i:6149;s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;s:15:"parent_category";i:415;}i:1;a:6:{s:4:"name";s:12:"p1.1.2.kurs2";s:2:"id";i:6276;s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;s:15:"parent_category";i:415;}i:2;a:6:{s:4:"name";s:12:"p1.1.2.kurs3";s:2:"id";i:6662;s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;s:15:"parent_category";i:415;}}}i:2;a:8:{s:2:"id";i:416;s:4:"name";s:6:"p1.1.3";s:15:"parent_category";i:407;s:7:"checked";i:0;s:13:"folderChecked";i:0;s:5:"buyed";i:0;s:8:"category";i:1;s:8:"children";a:3:{i:0;a:6:{s:4:"name";s:12:"p1.1.3.kurs1";s:2:"id";i:6075;s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;s:15:"parent_category";i:416;}i:1;a:6:{s:4:"name";s:12:"p1.1.3.kurs2";s:2:"id";i:6277;s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;s:15:"parent_category";i:416;}i:2;a:6:{s:4:"name";s:12:"p1.1.3.kurs3";s:2:"id";i:6663;s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;s:15:"parent_category";i:416;}}}}}i:1;a:8:{s:2:"id";i:471;s:4:"name";s:4:"p1.2";s:15:"parent_category";i:467;s:7:"checked";i:0;s:13:"folderChecked";i:0;s:5:"buyed";i:0;s:8:"category";i:1;s:8:"children";a:2:{i:0;a:8:{s:2:"id";i:473;s:4:"name";s:6:"p1.2.1";s:15:"parent_category";i:471;s:7:"checked";i:0;s:13:"folderChecked";i:0;s:5:"buyed";i:0;s:8:"category";i:1;s:8:"children";a:2:{i:0;a:8:{s:2:"id";i:533;s:4:"name";s:8:"p1.2.1.1";s:15:"parent_category";i:473;s:7:"checked";i:0;s:13:"folderChecked";i:0;s:5:"buyed";i:0;s:8:"category";i:1;s:8:"children";a:3:{i:0;a:6:{s:4:"name";s:14:"p1.2.1.1.kurs1";s:2:"id";i:5489;s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;s:15:"parent_category";i:533;}i:1;a:6:{s:4:"name";s:14:"p1.2.1.1.kurs2";s:2:"id";i:6082;s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;s:15:"parent_category";i:533;}i:2;a:6:{s:4:"name";s:14:"p1.2.1.1.kurs3";s:2:"id";i:6669;s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;s:15:"parent_category";i:533;}}}i:1;a:8:{s:2:"id";i:534;s:4:"name";s:8:"p1.2.1.2";s:15:"parent_category";i:473;s:7:"checked";i:0;s:13:"folderChecked";i:0;s:5:"buyed";i:0;s:8:"category";i:1;s:8:"children";a:3:{i:0;a:6:{s:4:"name";s:14:"p1.2.1.2.kurs1";s:2:"id";i:6207;s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;s:15:"parent_category";i:534;}i:1;a:6:{s:4:"name";s:14:"p1.2.1.2.kurs2";s:2:"id";i:6208;s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;s:15:"parent_category";i:534;}i:2;a:6:{s:4:"name";s:14:"p1.2.1.2.kurs3";s:2:"id";i:6670;s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;s:15:"parent_category";i:534;}}}}}i:1;a:8:{s:2:"id";i:527;s:4:"name";s:6:"p1.2.2";s:15:"parent_category";i:471;s:7:"checked";i:0;s:13:"folderChecked";i:0;s:5:"buyed";i:0;s:8:"category";i:1;s:8:"children";a:3:{i:0;a:6:{s:4:"name";s:12:"p1.2.2.kurs1";s:2:"id";i:4926;s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;s:15:"parent_category";i:527;}i:1;a:6:{s:4:"name";s:12:"p1.2.2.kurs2";s:2:"id";i:6469;s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;s:15:"parent_category";i:527;}i:2;a:6:{s:4:"name";s:12:"p1.2.2.kurs3";s:2:"id";i:6491;s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;s:15:"parent_category";i:527;}}}}}i:2;a:8:{s:2:"id";i:602;s:4:"name";s:4:"p1.3";s:15:"parent_category";i:467;s:7:"checked";i:0;s:13:"folderChecked";i:0;s:5:"buyed";i:0;s:8:"category";i:1;s:8:"children";a:3:{i:0;a:8:{s:2:"id";i:604;s:4:"name";s:6:"p1.3.1";s:15:"parent_category";i:602;s:7:"checked";i:0;s:13:"folderChecked";i:0;s:5:"buyed";i:0;s:8:"category";i:1;s:8:"children";a:3:{i:0;a:8:{s:2:"id";i:687;s:4:"name";s:8:"p1.3.1.1";s:15:"parent_category";i:604;s:7:"checked";i:0;s:13:"folderChecked";i:0;s:5:"buyed";i:0;s:8:"category";i:1;s:8:"children";a:3:{i:0;a:6:{s:4:"name";s:14:"p1.3.1.1.kurs1";s:2:"id";i:5664;s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;s:15:"parent_category";i:687;}i:1;a:6:{s:4:"name";s:14:"p1.3.1.1.kurs2";s:2:"id";i:6255;s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;s:15:"parent_category";i:687;}i:2;a:6:{s:4:"name";s:14:"p1.3.1.1.kurs3";s:2:"id";i:6675;s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;s:15:"parent_category";i:687;}}}i:1;a:8:{s:2:"id";i:688;s:4:"name";s:8:"p1.3.1.2";s:15:"parent_category";i:604;s:7:"checked";i:0;s:13:"folderChecked";i:0;s:5:"buyed";i:0;s:8:"category";i:1;s:8:"children";a:17:{i:0;a:6:{s:4:"name";s:14:"p1.3.1.2.kurs1";s:2:"id";i:4981;s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;s:15:"parent_category";i:688;}i:1;a:6:{s:4:"name";s:14:"p1.3.1.2.kurs2";s:2:"id";i:4984;s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;s:15:"parent_category";i:688;}i:2;a:6:{s:4:"name";s:14:"p1.3.1.2.kurs3";s:2:"id";i:5007;s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;s:15:"parent_category";i:688;}i:3;a:6:{s:4:"name";s:14:"p1.3.1.2.kurs4";s:2:"id";i:5010;s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;s:15:"parent_category";i:688;}i:4;a:6:{s:4:"name";s:14:"p1.3.1.2.kurs5";s:2:"id";i:5012;s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;s:15:"parent_category";i:688;}i:5;a:6:{s:4:"name";s:14:"p1.3.1.2.kurs6";s:2:"id";i:5668;s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;s:15:"parent_category";i:688;}i:6;a:6:{s:4:"name";s:14:"p1.3.1.2.kurs7";s:2:"id";i:5727;s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;s:15:"parent_category";i:688;}i:7;a:6:{s:4:"name";s:14:"p1.3.1.2.kurs8";s:2:"id";i:5728;s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;s:15:"parent_category";i:688;}i:8;a:6:{s:4:"name";s:14:"p1.3.1.2.kurs9";s:2:"id";i:5766;s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;s:15:"parent_category";i:688;}i:9;a:6:{s:4:"name";s:15:"p1.3.1.2.kurs10";s:2:"id";i:6089;s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;s:15:"parent_category";i:688;}i:10;a:6:{s:4:"name";s:15:"p1.3.1.2.kurs11";s:2:"id";i:6145;s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;s:15:"parent_category";i:688;}i:11;a:6:{s:4:"name";s:15:"p1.3.1.2.kurs12";s:2:"id";i:6256;s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;s:15:"parent_category";i:688;}i:12;a:6:{s:4:"name";s:15:"p1.3.1.2.kurs13";s:2:"id";i:6314;s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;s:15:"parent_category";i:688;}i:13;a:6:{s:4:"name";s:15:"p1.3.1.2.kurs14";s:2:"id";i:6349;s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;s:15:"parent_category";i:688;}i:14;a:6:{s:4:"name";s:15:"p1.3.1.2.kurs15";s:2:"id";i:6535;s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;s:15:"parent_category";i:688;}i:15;a:6:{s:4:"name";s:15:"p1.3.1.2.kurs16";s:2:"id";i:6536;s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;s:15:"parent_category";i:688;}i:16;a:6:{s:4:"name";s:15:"p1.3.1.2.kurs17";s:2:"id";i:6676;s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;s:15:"parent_category";i:688;}}}i:2;a:8:{s:2:"id";i:689;s:4:"name";s:8:"p1.3.1.3";s:15:"parent_category";i:604;s:7:"checked";i:0;s:13:"folderChecked";i:0;s:5:"buyed";i:0;s:8:"category";i:1;s:8:"children";a:3:{i:0;a:6:{s:4:"name";s:14:"p1.3.1.3.kurs1";s:2:"id";i:4986;s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;s:15:"parent_category";i:689;}i:1;a:6:{s:4:"name";s:14:"p1.3.1.3.kurs2";s:2:"id";i:6350;s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;s:15:"parent_category";i:689;}i:2;a:6:{s:4:"name";s:14:"p1.3.1.3.kurs3";s:2:"id";i:6677;s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;s:15:"parent_category";i:689;}}}}}i:1;a:8:{s:2:"id";i:605;s:4:"name";s:6:"p1.3.2";s:15:"parent_category";i:602;s:7:"checked";i:0;s:13:"folderChecked";i:0;s:5:"buyed";i:0;s:8:"category";i:1;s:8:"children";a:16:{i:0;a:6:{s:4:"name";s:12:"p1.3.2.kurs1";s:2:"id";i:5614;s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;s:15:"parent_category";i:605;}i:1;a:6:{s:4:"name";s:12:"p1.3.2.kurs2";s:2:"id";i:5617;s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;s:15:"parent_category";i:605;}i:2;a:6:{s:4:"name";s:12:"p1.3.2.kurs3";s:2:"id";i:5760;s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;s:15:"parent_category";i:605;}i:3;a:6:{s:4:"name";s:12:"p1.3.2.kurs4";s:2:"id";i:5835;s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;s:15:"parent_category";i:605;}i:4;a:6:{s:4:"name";s:12:"p1.3.2.kurs5";s:2:"id";i:5867;s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;s:15:"parent_category";i:605;}i:5;a:6:{s:4:"name";s:12:"p1.3.2.kurs6";s:2:"id";i:6068;s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;s:15:"parent_category";i:605;}i:6;a:6:{s:4:"name";s:12:"p1.3.2.kurs7";s:2:"id";i:6069;s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;s:15:"parent_category";i:605;}i:7;a:6:{s:4:"name";s:12:"p1.3.2.kurs8";s:2:"id";i:6241;s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;s:15:"parent_category";i:605;}i:8;a:6:{s:4:"name";s:12:"p1.3.2.kurs9";s:2:"id";i:6242;s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;s:15:"parent_category";i:605;}i:9;a:6:{s:4:"name";s:13:"p1.3.2.kurs10";s:2:"id";i:6257;s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;s:15:"parent_category";i:605;}i:10;a:6:{s:4:"name";s:13:"p1.3.2.kurs11";s:2:"id";i:6299;s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;s:15:"parent_category";i:605;}i:11;a:6:{s:4:"name";s:13:"p1.3.2.kurs12";s:2:"id";i:6474;s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;s:15:"parent_category";i:605;}i:12;a:6:{s:4:"name";s:13:"p1.3.2.kurs13";s:2:"id";i:6475;s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;s:15:"parent_category";i:605;}i:13;a:6:{s:4:"name";s:13:"p1.3.2.kurs14";s:2:"id";i:6493;s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;s:15:"parent_category";i:605;}i:14;a:6:{s:4:"name";s:13:"p1.3.2.kurs15";s:2:"id";i:6494;s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;s:15:"parent_category";i:605;}i:15;a:6:{s:4:"name";s:13:"p1.3.2.kurs16";s:2:"id";i:6728;s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;s:15:"parent_category";i:605;}}}i:2;a:8:{s:2:"id";i:606;s:4:"name";s:6:"p1.3.3";s:15:"parent_category";i:602;s:7:"checked";i:0;s:13:"folderChecked";i:0;s:5:"buyed";i:0;s:8:"category";i:1;s:8:"children";a:3:{i:0;a:6:{s:4:"name";s:12:"p1.3.3.kurs1";s:2:"id";i:5680;s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;s:15:"parent_category";i:606;}i:1;a:6:{s:4:"name";s:12:"p1.3.3.kurs2";s:2:"id";i:5732;s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;s:15:"parent_category";i:606;}i:2;a:6:{s:4:"name";s:12:"p1.3.3.kurs3";s:2:"id";i:6301;s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;s:15:"parent_category";i:606;}}}}}}}}';

	$fullArray = 'a:1:{i:0;a:8:{s:2:"id";i:467;s:4:"name";s:2:"p1";s:15:"parent_category";i:0;s:7:"checked";i:1;s:13:"folderChecked";i:1;s:5:"buyed";i:0;s:8:"category";i:1;s:8:"children";a:3:{i:0;a:8:{s:2:"id";i:407;s:4:"name";s:4:"p1.1";s:15:"parent_category";i:467;s:7:"checked";i:1;s:13:"folderChecked";i:1;s:5:"buyed";i:0;s:8:"category";i:1;s:8:"children";a:3:{i:0;a:8:{s:2:"id";i:408;s:4:"name";s:6:"p1.1.1";s:15:"parent_category";i:407;s:7:"checked";i:1;s:13:"folderChecked";i:1;s:5:"buyed";i:0;s:8:"category";i:1;s:8:"children";a:3:{i:0;a:6:{s:4:"name";s:12:"p1.1.1.kurs1";s:2:"id";i:4242;s:8:"category";i:0;s:7:"checked";i:1;s:13:"folderChecked";i:0;s:15:"parent_category";i:408;}i:1;a:6:{s:4:"name";s:12:"p1.1.1.kurs2";s:2:"id";i:4245;s:8:"category";i:0;s:7:"checked";i:1;s:13:"folderChecked";i:0;s:15:"parent_category";i:408;}i:2;a:6:{s:4:"name";s:12:"p1.1.1.kurs3";s:2:"id";i:5846;s:8:"category";i:0;s:7:"checked";i:1;s:13:"folderChecked";i:0;s:15:"parent_category";i:408;}}}i:1;a:8:{s:2:"id";i:415;s:4:"name";s:6:"p1.1.2";s:15:"parent_category";i:407;s:7:"checked";i:1;s:13:"folderChecked";i:1;s:5:"buyed";i:0;s:8:"category";i:1;s:8:"children";a:3:{i:0;a:6:{s:4:"name";s:12:"p1.1.2.kurs1";s:2:"id";i:6149;s:8:"category";i:0;s:7:"checked";i:1;s:13:"folderChecked";i:0;s:15:"parent_category";i:415;}i:1;a:6:{s:4:"name";s:12:"p1.1.2.kurs2";s:2:"id";i:6276;s:8:"category";i:0;s:7:"checked";i:1;s:13:"folderChecked";i:0;s:15:"parent_category";i:415;}i:2;a:6:{s:4:"name";s:12:"p1.1.2.kurs3";s:2:"id";i:6662;s:8:"category";i:0;s:7:"checked";i:1;s:13:"folderChecked";i:0;s:15:"parent_category";i:415;}}}i:2;a:8:{s:2:"id";i:416;s:4:"name";s:6:"p1.1.3";s:15:"parent_category";i:407;s:7:"checked";i:1;s:13:"folderChecked";i:1;s:5:"buyed";i:0;s:8:"category";i:1;s:8:"children";a:3:{i:0;a:6:{s:4:"name";s:12:"p1.1.3.kurs1";s:2:"id";i:6075;s:8:"category";i:0;s:7:"checked";i:1;s:13:"folderChecked";i:0;s:15:"parent_category";i:416;}i:1;a:6:{s:4:"name";s:12:"p1.1.3.kurs2";s:2:"id";i:6277;s:8:"category";i:0;s:7:"checked";i:1;s:13:"folderChecked";i:0;s:15:"parent_category";i:416;}i:2;a:6:{s:4:"name";s:12:"p1.1.3.kurs3";s:2:"id";i:6663;s:8:"category";i:0;s:7:"checked";i:1;s:13:"folderChecked";i:0;s:15:"parent_category";i:416;}}}}}i:1;a:8:{s:2:"id";i:471;s:4:"name";s:4:"p1.2";s:15:"parent_category";i:467;s:7:"checked";i:1;s:13:"folderChecked";i:1;s:5:"buyed";i:0;s:8:"category";i:1;s:8:"children";a:2:{i:0;a:8:{s:2:"id";i:473;s:4:"name";s:6:"p1.2.1";s:15:"parent_category";i:471;s:7:"checked";i:1;s:13:"folderChecked";i:1;s:5:"buyed";i:0;s:8:"category";i:1;s:8:"children";a:2:{i:0;a:8:{s:2:"id";i:533;s:4:"name";s:8:"p1.2.1.1";s:15:"parent_category";i:473;s:7:"checked";i:1;s:13:"folderChecked";i:1;s:5:"buyed";i:0;s:8:"category";i:1;s:8:"children";a:3:{i:0;a:6:{s:4:"name";s:14:"p1.2.1.1.kurs1";s:2:"id";i:5489;s:8:"category";i:0;s:7:"checked";i:1;s:13:"folderChecked";i:0;s:15:"parent_category";i:533;}i:1;a:6:{s:4:"name";s:14:"p1.2.1.1.kurs2";s:2:"id";i:6082;s:8:"category";i:0;s:7:"checked";i:1;s:13:"folderChecked";i:0;s:15:"parent_category";i:533;}i:2;a:6:{s:4:"name";s:14:"p1.2.1.1.kurs3";s:2:"id";i:6669;s:8:"category";i:0;s:7:"checked";i:1;s:13:"folderChecked";i:0;s:15:"parent_category";i:533;}}}i:1;a:8:{s:2:"id";i:534;s:4:"name";s:8:"p1.2.1.2";s:15:"parent_category";i:473;s:7:"checked";i:1;s:13:"folderChecked";i:1;s:5:"buyed";i:0;s:8:"category";i:1;s:8:"children";a:3:{i:0;a:6:{s:4:"name";s:14:"p1.2.1.2.kurs1";s:2:"id";i:6207;s:8:"category";i:0;s:7:"checked";i:1;s:13:"folderChecked";i:0;s:15:"parent_category";i:534;}i:1;a:6:{s:4:"name";s:14:"p1.2.1.2.kurs2";s:2:"id";i:6208;s:8:"category";i:0;s:7:"checked";i:1;s:13:"folderChecked";i:0;s:15:"parent_category";i:534;}i:2;a:6:{s:4:"name";s:14:"p1.2.1.2.kurs3";s:2:"id";i:6670;s:8:"category";i:0;s:7:"checked";i:1;s:13:"folderChecked";i:0;s:15:"parent_category";i:534;}}}}}i:1;a:8:{s:2:"id";i:527;s:4:"name";s:6:"p1.2.2";s:15:"parent_category";i:471;s:7:"checked";i:1;s:13:"folderChecked";i:1;s:5:"buyed";i:0;s:8:"category";i:1;s:8:"children";a:3:{i:0;a:6:{s:4:"name";s:12:"p1.2.2.kurs1";s:2:"id";i:4926;s:8:"category";i:0;s:7:"checked";i:1;s:13:"folderChecked";i:0;s:15:"parent_category";i:527;}i:1;a:6:{s:4:"name";s:12:"p1.2.2.kurs2";s:2:"id";i:6469;s:8:"category";i:0;s:7:"checked";i:1;s:13:"folderChecked";i:0;s:15:"parent_category";i:527;}i:2;a:6:{s:4:"name";s:12:"p1.2.2.kurs3";s:2:"id";i:6491;s:8:"category";i:0;s:7:"checked";i:1;s:13:"folderChecked";i:0;s:15:"parent_category";i:527;}}}}}i:2;a:8:{s:2:"id";i:602;s:4:"name";s:4:"p1.3";s:15:"parent_category";i:467;s:7:"checked";i:1;s:13:"folderChecked";i:1;s:5:"buyed";i:0;s:8:"category";i:1;s:8:"children";a:3:{i:0;a:8:{s:2:"id";i:604;s:4:"name";s:6:"p1.3.1";s:15:"parent_category";i:602;s:7:"checked";i:1;s:13:"folderChecked";i:1;s:5:"buyed";i:0;s:8:"category";i:1;s:8:"children";a:3:{i:0;a:8:{s:2:"id";i:687;s:4:"name";s:8:"p1.3.1.1";s:15:"parent_category";i:604;s:7:"checked";i:1;s:13:"folderChecked";i:1;s:5:"buyed";i:0;s:8:"category";i:1;s:8:"children";a:3:{i:0;a:6:{s:4:"name";s:14:"p1.3.1.1.kurs1";s:2:"id";i:5664;s:8:"category";i:0;s:7:"checked";i:1;s:13:"folderChecked";i:0;s:15:"parent_category";i:687;}i:1;a:6:{s:4:"name";s:14:"p1.3.1.1.kurs2";s:2:"id";i:6255;s:8:"category";i:0;s:7:"checked";i:1;s:13:"folderChecked";i:0;s:15:"parent_category";i:687;}i:2;a:6:{s:4:"name";s:14:"p1.3.1.1.kurs3";s:2:"id";i:6675;s:8:"category";i:0;s:7:"checked";i:1;s:13:"folderChecked";i:0;s:15:"parent_category";i:687;}}}i:1;a:8:{s:2:"id";i:688;s:4:"name";s:8:"p1.3.1.2";s:15:"parent_category";i:604;s:7:"checked";i:1;s:13:"folderChecked";i:1;s:5:"buyed";i:0;s:8:"category";i:1;s:8:"children";a:17:{i:0;a:6:{s:4:"name";s:14:"p1.3.1.2.kurs1";s:2:"id";i:4981;s:8:"category";i:0;s:7:"checked";i:1;s:13:"folderChecked";i:0;s:15:"parent_category";i:688;}i:1;a:6:{s:4:"name";s:14:"p1.3.1.2.kurs2";s:2:"id";i:4984;s:8:"category";i:0;s:7:"checked";i:1;s:13:"folderChecked";i:0;s:15:"parent_category";i:688;}i:2;a:6:{s:4:"name";s:14:"p1.3.1.2.kurs3";s:2:"id";i:5007;s:8:"category";i:0;s:7:"checked";i:1;s:13:"folderChecked";i:0;s:15:"parent_category";i:688;}i:3;a:6:{s:4:"name";s:14:"p1.3.1.2.kurs4";s:2:"id";i:5010;s:8:"category";i:0;s:7:"checked";i:1;s:13:"folderChecked";i:0;s:15:"parent_category";i:688;}i:4;a:6:{s:4:"name";s:14:"p1.3.1.2.kurs5";s:2:"id";i:5012;s:8:"category";i:0;s:7:"checked";i:1;s:13:"folderChecked";i:0;s:15:"parent_category";i:688;}i:5;a:6:{s:4:"name";s:14:"p1.3.1.2.kurs6";s:2:"id";i:5668;s:8:"category";i:0;s:7:"checked";i:1;s:13:"folderChecked";i:0;s:15:"parent_category";i:688;}i:6;a:6:{s:4:"name";s:14:"p1.3.1.2.kurs7";s:2:"id";i:5727;s:8:"category";i:0;s:7:"checked";i:1;s:13:"folderChecked";i:0;s:15:"parent_category";i:688;}i:7;a:6:{s:4:"name";s:14:"p1.3.1.2.kurs8";s:2:"id";i:5728;s:8:"category";i:0;s:7:"checked";i:1;s:13:"folderChecked";i:0;s:15:"parent_category";i:688;}i:8;a:6:{s:4:"name";s:14:"p1.3.1.2.kurs9";s:2:"id";i:5766;s:8:"category";i:0;s:7:"checked";i:1;s:13:"folderChecked";i:0;s:15:"parent_category";i:688;}i:9;a:6:{s:4:"name";s:15:"p1.3.1.2.kurs10";s:2:"id";i:6089;s:8:"category";i:0;s:7:"checked";i:1;s:13:"folderChecked";i:0;s:15:"parent_category";i:688;}i:10;a:6:{s:4:"name";s:15:"p1.3.1.2.kurs11";s:2:"id";i:6145;s:8:"category";i:0;s:7:"checked";i:1;s:13:"folderChecked";i:0;s:15:"parent_category";i:688;}i:11;a:6:{s:4:"name";s:15:"p1.3.1.2.kurs12";s:2:"id";i:6256;s:8:"category";i:0;s:7:"checked";i:1;s:13:"folderChecked";i:0;s:15:"parent_category";i:688;}i:12;a:6:{s:4:"name";s:15:"p1.3.1.2.kurs13";s:2:"id";i:6314;s:8:"category";i:0;s:7:"checked";i:1;s:13:"folderChecked";i:0;s:15:"parent_category";i:688;}i:13;a:6:{s:4:"name";s:15:"p1.3.1.2.kurs14";s:2:"id";i:6349;s:8:"category";i:0;s:7:"checked";i:1;s:13:"folderChecked";i:0;s:15:"parent_category";i:688;}i:14;a:6:{s:4:"name";s:15:"p1.3.1.2.kurs15";s:2:"id";i:6535;s:8:"category";i:0;s:7:"checked";i:1;s:13:"folderChecked";i:0;s:15:"parent_category";i:688;}i:15;a:6:{s:4:"name";s:15:"p1.3.1.2.kurs16";s:2:"id";i:6536;s:8:"category";i:0;s:7:"checked";i:1;s:13:"folderChecked";i:0;s:15:"parent_category";i:688;}i:16;a:6:{s:4:"name";s:15:"p1.3.1.2.kurs17";s:2:"id";i:6676;s:8:"category";i:0;s:7:"checked";i:1;s:13:"folderChecked";i:0;s:15:"parent_category";i:688;}}}i:2;a:8:{s:2:"id";i:689;s:4:"name";s:8:"p1.3.1.3";s:15:"parent_category";i:604;s:7:"checked";i:1;s:13:"folderChecked";i:1;s:5:"buyed";i:0;s:8:"category";i:1;s:8:"children";a:3:{i:0;a:6:{s:4:"name";s:14:"p1.3.1.3.kurs1";s:2:"id";i:4986;s:8:"category";i:0;s:7:"checked";i:1;s:13:"folderChecked";i:0;s:15:"parent_category";i:689;}i:1;a:6:{s:4:"name";s:14:"p1.3.1.3.kurs2";s:2:"id";i:6350;s:8:"category";i:0;s:7:"checked";i:1;s:13:"folderChecked";i:0;s:15:"parent_category";i:689;}i:2;a:6:{s:4:"name";s:14:"p1.3.1.3.kurs3";s:2:"id";i:6677;s:8:"category";i:0;s:7:"checked";i:1;s:13:"folderChecked";i:0;s:15:"parent_category";i:689;}}}}}i:1;a:8:{s:2:"id";i:605;s:4:"name";s:6:"p1.3.2";s:15:"parent_category";i:602;s:7:"checked";i:1;s:13:"folderChecked";i:1;s:5:"buyed";i:0;s:8:"category";i:1;s:8:"children";a:16:{i:0;a:6:{s:4:"name";s:12:"p1.3.2.kurs1";s:2:"id";i:5614;s:8:"category";i:0;s:7:"checked";i:1;s:13:"folderChecked";i:0;s:15:"parent_category";i:605;}i:1;a:6:{s:4:"name";s:12:"p1.3.2.kurs2";s:2:"id";i:5617;s:8:"category";i:0;s:7:"checked";i:1;s:13:"folderChecked";i:0;s:15:"parent_category";i:605;}i:2;a:6:{s:4:"name";s:12:"p1.3.2.kurs3";s:2:"id";i:5760;s:8:"category";i:0;s:7:"checked";i:1;s:13:"folderChecked";i:0;s:15:"parent_category";i:605;}i:3;a:6:{s:4:"name";s:12:"p1.3.2.kurs4";s:2:"id";i:5835;s:8:"category";i:0;s:7:"checked";i:1;s:13:"folderChecked";i:0;s:15:"parent_category";i:605;}i:4;a:6:{s:4:"name";s:12:"p1.3.2.kurs5";s:2:"id";i:5867;s:8:"category";i:0;s:7:"checked";i:1;s:13:"folderChecked";i:0;s:15:"parent_category";i:605;}i:5;a:6:{s:4:"name";s:12:"p1.3.2.kurs6";s:2:"id";i:6068;s:8:"category";i:0;s:7:"checked";i:1;s:13:"folderChecked";i:0;s:15:"parent_category";i:605;}i:6;a:6:{s:4:"name";s:12:"p1.3.2.kurs7";s:2:"id";i:6069;s:8:"category";i:0;s:7:"checked";i:1;s:13:"folderChecked";i:0;s:15:"parent_category";i:605;}i:7;a:6:{s:4:"name";s:12:"p1.3.2.kurs8";s:2:"id";i:6241;s:8:"category";i:0;s:7:"checked";i:1;s:13:"folderChecked";i:0;s:15:"parent_category";i:605;}i:8;a:6:{s:4:"name";s:12:"p1.3.2.kurs9";s:2:"id";i:6242;s:8:"category";i:0;s:7:"checked";i:1;s:13:"folderChecked";i:0;s:15:"parent_category";i:605;}i:9;a:6:{s:4:"name";s:13:"p1.3.2.kurs10";s:2:"id";i:6257;s:8:"category";i:0;s:7:"checked";i:1;s:13:"folderChecked";i:0;s:15:"parent_category";i:605;}i:10;a:6:{s:4:"name";s:13:"p1.3.2.kurs11";s:2:"id";i:6299;s:8:"category";i:0;s:7:"checked";i:1;s:13:"folderChecked";i:0;s:15:"parent_category";i:605;}i:11;a:6:{s:4:"name";s:13:"p1.3.2.kurs12";s:2:"id";i:6474;s:8:"category";i:0;s:7:"checked";i:1;s:13:"folderChecked";i:0;s:15:"parent_category";i:605;}i:12;a:6:{s:4:"name";s:13:"p1.3.2.kurs13";s:2:"id";i:6475;s:8:"category";i:0;s:7:"checked";i:1;s:13:"folderChecked";i:0;s:15:"parent_category";i:605;}i:13;a:6:{s:4:"name";s:13:"p1.3.2.kurs14";s:2:"id";i:6493;s:8:"category";i:0;s:7:"checked";i:1;s:13:"folderChecked";i:0;s:15:"parent_category";i:605;}i:14;a:6:{s:4:"name";s:13:"p1.3.2.kurs15";s:2:"id";i:6494;s:8:"category";i:0;s:7:"checked";i:1;s:13:"folderChecked";i:0;s:15:"parent_category";i:605;}i:15;a:6:{s:4:"name";s:13:"p1.3.2.kurs16";s:2:"id";i:6728;s:8:"category";i:0;s:7:"checked";i:1;s:13:"folderChecked";i:0;s:15:"parent_category";i:605;}}}i:2;a:8:{s:2:"id";i:606;s:4:"name";s:6:"p1.3.3";s:15:"parent_category";i:602;s:7:"checked";i:1;s:13:"folderChecked";i:1;s:5:"buyed";i:0;s:8:"category";i:1;s:8:"children";a:3:{i:0;a:6:{s:4:"name";s:12:"p1.3.3.kurs1";s:2:"id";i:5680;s:8:"category";i:0;s:7:"checked";i:1;s:13:"folderChecked";i:0;s:15:"parent_category";i:606;}i:1;a:6:{s:4:"name";s:12:"p1.3.3.kurs2";s:2:"id";i:5732;s:8:"category";i:0;s:7:"checked";i:1;s:13:"folderChecked";i:0;s:15:"parent_category";i:606;}i:2;a:6:{s:4:"name";s:12:"p1.3.3.kurs3";s:2:"id";i:6301;s:8:"category";i:0;s:7:"checked";i:1;s:13:"folderChecked";i:0;s:15:"parent_category";i:606;}}}}}}}}';

	$fullWithoutOneArray = 'a:1:{i:0;a:8:{s:2:"id";i:467;s:4:"name";s:2:"p1";s:15:"parent_category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:1;s:5:"buyed";i:0;s:8:"category";i:1;s:8:"children";a:3:{i:0;a:8:{s:2:"id";i:407;s:4:"name";s:4:"p1.1";s:15:"parent_category";i:467;s:7:"checked";i:0;s:13:"folderChecked";i:1;s:5:"buyed";i:0;s:8:"category";i:1;s:8:"children";a:3:{i:0;a:8:{s:2:"id";i:408;s:4:"name";s:6:"p1.1.1";s:15:"parent_category";i:407;s:7:"checked";i:0;s:13:"folderChecked";i:1;s:5:"buyed";i:0;s:8:"category";i:1;s:8:"children";a:3:{i:0;a:6:{s:4:"name";s:12:"p1.1.1.kurs1";s:2:"id";i:4242;s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;s:15:"parent_category";i:408;}i:1;a:6:{s:4:"name";s:12:"p1.1.1.kurs2";s:2:"id";i:4245;s:8:"category";i:0;s:7:"checked";i:1;s:13:"folderChecked";i:0;s:15:"parent_category";i:408;}i:2;a:6:{s:4:"name";s:12:"p1.1.1.kurs3";s:2:"id";i:5846;s:8:"category";i:0;s:7:"checked";i:1;s:13:"folderChecked";i:0;s:15:"parent_category";i:408;}}}i:1;a:8:{s:2:"id";i:415;s:4:"name";s:6:"p1.1.2";s:15:"parent_category";i:407;s:7:"checked";i:1;s:13:"folderChecked";i:1;s:5:"buyed";i:0;s:8:"category";i:1;s:8:"children";a:3:{i:0;a:6:{s:4:"name";s:12:"p1.1.2.kurs1";s:2:"id";i:6149;s:8:"category";i:0;s:7:"checked";i:1;s:13:"folderChecked";i:0;s:15:"parent_category";i:415;}i:1;a:6:{s:4:"name";s:12:"p1.1.2.kurs2";s:2:"id";i:6276;s:8:"category";i:0;s:7:"checked";i:1;s:13:"folderChecked";i:0;s:15:"parent_category";i:415;}i:2;a:6:{s:4:"name";s:12:"p1.1.2.kurs3";s:2:"id";i:6662;s:8:"category";i:0;s:7:"checked";i:1;s:13:"folderChecked";i:0;s:15:"parent_category";i:415;}}}i:2;a:8:{s:2:"id";i:416;s:4:"name";s:6:"p1.1.3";s:15:"parent_category";i:407;s:7:"checked";i:1;s:13:"folderChecked";i:1;s:5:"buyed";i:0;s:8:"category";i:1;s:8:"children";a:3:{i:0;a:6:{s:4:"name";s:12:"p1.1.3.kurs1";s:2:"id";i:6075;s:8:"category";i:0;s:7:"checked";i:1;s:13:"folderChecked";i:0;s:15:"parent_category";i:416;}i:1;a:6:{s:4:"name";s:12:"p1.1.3.kurs2";s:2:"id";i:6277;s:8:"category";i:0;s:7:"checked";i:1;s:13:"folderChecked";i:0;s:15:"parent_category";i:416;}i:2;a:6:{s:4:"name";s:12:"p1.1.3.kurs3";s:2:"id";i:6663;s:8:"category";i:0;s:7:"checked";i:1;s:13:"folderChecked";i:0;s:15:"parent_category";i:416;}}}}}i:1;a:8:{s:2:"id";i:471;s:4:"name";s:4:"p1.2";s:15:"parent_category";i:467;s:7:"checked";i:1;s:13:"folderChecked";i:1;s:5:"buyed";i:0;s:8:"category";i:1;s:8:"children";a:2:{i:0;a:8:{s:2:"id";i:473;s:4:"name";s:6:"p1.2.1";s:15:"parent_category";i:471;s:7:"checked";i:1;s:13:"folderChecked";i:1;s:5:"buyed";i:0;s:8:"category";i:1;s:8:"children";a:2:{i:0;a:8:{s:2:"id";i:533;s:4:"name";s:8:"p1.2.1.1";s:15:"parent_category";i:473;s:7:"checked";i:1;s:13:"folderChecked";i:1;s:5:"buyed";i:0;s:8:"category";i:1;s:8:"children";a:3:{i:0;a:6:{s:4:"name";s:14:"p1.2.1.1.kurs1";s:2:"id";i:5489;s:8:"category";i:0;s:7:"checked";i:1;s:13:"folderChecked";i:0;s:15:"parent_category";i:533;}i:1;a:6:{s:4:"name";s:14:"p1.2.1.1.kurs2";s:2:"id";i:6082;s:8:"category";i:0;s:7:"checked";i:1;s:13:"folderChecked";i:0;s:15:"parent_category";i:533;}i:2;a:6:{s:4:"name";s:14:"p1.2.1.1.kurs3";s:2:"id";i:6669;s:8:"category";i:0;s:7:"checked";i:1;s:13:"folderChecked";i:0;s:15:"parent_category";i:533;}}}i:1;a:8:{s:2:"id";i:534;s:4:"name";s:8:"p1.2.1.2";s:15:"parent_category";i:473;s:7:"checked";i:1;s:13:"folderChecked";i:1;s:5:"buyed";i:0;s:8:"category";i:1;s:8:"children";a:3:{i:0;a:6:{s:4:"name";s:14:"p1.2.1.2.kurs1";s:2:"id";i:6207;s:8:"category";i:0;s:7:"checked";i:1;s:13:"folderChecked";i:0;s:15:"parent_category";i:534;}i:1;a:6:{s:4:"name";s:14:"p1.2.1.2.kurs2";s:2:"id";i:6208;s:8:"category";i:0;s:7:"checked";i:1;s:13:"folderChecked";i:0;s:15:"parent_category";i:534;}i:2;a:6:{s:4:"name";s:14:"p1.2.1.2.kurs3";s:2:"id";i:6670;s:8:"category";i:0;s:7:"checked";i:1;s:13:"folderChecked";i:0;s:15:"parent_category";i:534;}}}}}i:1;a:8:{s:2:"id";i:527;s:4:"name";s:6:"p1.2.2";s:15:"parent_category";i:471;s:7:"checked";i:1;s:13:"folderChecked";i:1;s:5:"buyed";i:0;s:8:"category";i:1;s:8:"children";a:3:{i:0;a:6:{s:4:"name";s:12:"p1.2.2.kurs1";s:2:"id";i:4926;s:8:"category";i:0;s:7:"checked";i:1;s:13:"folderChecked";i:0;s:15:"parent_category";i:527;}i:1;a:6:{s:4:"name";s:12:"p1.2.2.kurs2";s:2:"id";i:6469;s:8:"category";i:0;s:7:"checked";i:1;s:13:"folderChecked";i:0;s:15:"parent_category";i:527;}i:2;a:6:{s:4:"name";s:12:"p1.2.2.kurs3";s:2:"id";i:6491;s:8:"category";i:0;s:7:"checked";i:1;s:13:"folderChecked";i:0;s:15:"parent_category";i:527;}}}}}i:2;a:8:{s:2:"id";i:602;s:4:"name";s:4:"p1.3";s:15:"parent_category";i:467;s:7:"checked";i:1;s:13:"folderChecked";i:1;s:5:"buyed";i:0;s:8:"category";i:1;s:8:"children";a:3:{i:0;a:8:{s:2:"id";i:604;s:4:"name";s:6:"p1.3.1";s:15:"parent_category";i:602;s:7:"checked";i:1;s:13:"folderChecked";i:1;s:5:"buyed";i:0;s:8:"category";i:1;s:8:"children";a:3:{i:0;a:8:{s:2:"id";i:687;s:4:"name";s:8:"p1.3.1.1";s:15:"parent_category";i:604;s:7:"checked";i:1;s:13:"folderChecked";i:1;s:5:"buyed";i:0;s:8:"category";i:1;s:8:"children";a:3:{i:0;a:6:{s:4:"name";s:14:"p1.3.1.1.kurs1";s:2:"id";i:5664;s:8:"category";i:0;s:7:"checked";i:1;s:13:"folderChecked";i:0;s:15:"parent_category";i:687;}i:1;a:6:{s:4:"name";s:14:"p1.3.1.1.kurs2";s:2:"id";i:6255;s:8:"category";i:0;s:7:"checked";i:1;s:13:"folderChecked";i:0;s:15:"parent_category";i:687;}i:2;a:6:{s:4:"name";s:14:"p1.3.1.1.kurs3";s:2:"id";i:6675;s:8:"category";i:0;s:7:"checked";i:1;s:13:"folderChecked";i:0;s:15:"parent_category";i:687;}}}i:1;a:8:{s:2:"id";i:688;s:4:"name";s:8:"p1.3.1.2";s:15:"parent_category";i:604;s:7:"checked";i:1;s:13:"folderChecked";i:1;s:5:"buyed";i:0;s:8:"category";i:1;s:8:"children";a:17:{i:0;a:6:{s:4:"name";s:14:"p1.3.1.2.kurs1";s:2:"id";i:4981;s:8:"category";i:0;s:7:"checked";i:1;s:13:"folderChecked";i:0;s:15:"parent_category";i:688;}i:1;a:6:{s:4:"name";s:14:"p1.3.1.2.kurs2";s:2:"id";i:4984;s:8:"category";i:0;s:7:"checked";i:1;s:13:"folderChecked";i:0;s:15:"parent_category";i:688;}i:2;a:6:{s:4:"name";s:14:"p1.3.1.2.kurs3";s:2:"id";i:5007;s:8:"category";i:0;s:7:"checked";i:1;s:13:"folderChecked";i:0;s:15:"parent_category";i:688;}i:3;a:6:{s:4:"name";s:14:"p1.3.1.2.kurs4";s:2:"id";i:5010;s:8:"category";i:0;s:7:"checked";i:1;s:13:"folderChecked";i:0;s:15:"parent_category";i:688;}i:4;a:6:{s:4:"name";s:14:"p1.3.1.2.kurs5";s:2:"id";i:5012;s:8:"category";i:0;s:7:"checked";i:1;s:13:"folderChecked";i:0;s:15:"parent_category";i:688;}i:5;a:6:{s:4:"name";s:14:"p1.3.1.2.kurs6";s:2:"id";i:5668;s:8:"category";i:0;s:7:"checked";i:1;s:13:"folderChecked";i:0;s:15:"parent_category";i:688;}i:6;a:6:{s:4:"name";s:14:"p1.3.1.2.kurs7";s:2:"id";i:5727;s:8:"category";i:0;s:7:"checked";i:1;s:13:"folderChecked";i:0;s:15:"parent_category";i:688;}i:7;a:6:{s:4:"name";s:14:"p1.3.1.2.kurs8";s:2:"id";i:5728;s:8:"category";i:0;s:7:"checked";i:1;s:13:"folderChecked";i:0;s:15:"parent_category";i:688;}i:8;a:6:{s:4:"name";s:14:"p1.3.1.2.kurs9";s:2:"id";i:5766;s:8:"category";i:0;s:7:"checked";i:1;s:13:"folderChecked";i:0;s:15:"parent_category";i:688;}i:9;a:6:{s:4:"name";s:15:"p1.3.1.2.kurs10";s:2:"id";i:6089;s:8:"category";i:0;s:7:"checked";i:1;s:13:"folderChecked";i:0;s:15:"parent_category";i:688;}i:10;a:6:{s:4:"name";s:15:"p1.3.1.2.kurs11";s:2:"id";i:6145;s:8:"category";i:0;s:7:"checked";i:1;s:13:"folderChecked";i:0;s:15:"parent_category";i:688;}i:11;a:6:{s:4:"name";s:15:"p1.3.1.2.kurs12";s:2:"id";i:6256;s:8:"category";i:0;s:7:"checked";i:1;s:13:"folderChecked";i:0;s:15:"parent_category";i:688;}i:12;a:6:{s:4:"name";s:15:"p1.3.1.2.kurs13";s:2:"id";i:6314;s:8:"category";i:0;s:7:"checked";i:1;s:13:"folderChecked";i:0;s:15:"parent_category";i:688;}i:13;a:6:{s:4:"name";s:15:"p1.3.1.2.kurs14";s:2:"id";i:6349;s:8:"category";i:0;s:7:"checked";i:1;s:13:"folderChecked";i:0;s:15:"parent_category";i:688;}i:14;a:6:{s:4:"name";s:15:"p1.3.1.2.kurs15";s:2:"id";i:6535;s:8:"category";i:0;s:7:"checked";i:1;s:13:"folderChecked";i:0;s:15:"parent_category";i:688;}i:15;a:6:{s:4:"name";s:15:"p1.3.1.2.kurs16";s:2:"id";i:6536;s:8:"category";i:0;s:7:"checked";i:1;s:13:"folderChecked";i:0;s:15:"parent_category";i:688;}i:16;a:6:{s:4:"name";s:15:"p1.3.1.2.kurs17";s:2:"id";i:6676;s:8:"category";i:0;s:7:"checked";i:1;s:13:"folderChecked";i:0;s:15:"parent_category";i:688;}}}i:2;a:8:{s:2:"id";i:689;s:4:"name";s:8:"p1.3.1.3";s:15:"parent_category";i:604;s:7:"checked";i:1;s:13:"folderChecked";i:1;s:5:"buyed";i:0;s:8:"category";i:1;s:8:"children";a:3:{i:0;a:6:{s:4:"name";s:14:"p1.3.1.3.kurs1";s:2:"id";i:4986;s:8:"category";i:0;s:7:"checked";i:1;s:13:"folderChecked";i:0;s:15:"parent_category";i:689;}i:1;a:6:{s:4:"name";s:14:"p1.3.1.3.kurs2";s:2:"id";i:6350;s:8:"category";i:0;s:7:"checked";i:1;s:13:"folderChecked";i:0;s:15:"parent_category";i:689;}i:2;a:6:{s:4:"name";s:14:"p1.3.1.3.kurs3";s:2:"id";i:6677;s:8:"category";i:0;s:7:"checked";i:1;s:13:"folderChecked";i:0;s:15:"parent_category";i:689;}}}}}i:1;a:8:{s:2:"id";i:605;s:4:"name";s:6:"p1.3.2";s:15:"parent_category";i:602;s:7:"checked";i:1;s:13:"folderChecked";i:1;s:5:"buyed";i:0;s:8:"category";i:1;s:8:"children";a:16:{i:0;a:6:{s:4:"name";s:12:"p1.3.2.kurs1";s:2:"id";i:5614;s:8:"category";i:0;s:7:"checked";i:1;s:13:"folderChecked";i:0;s:15:"parent_category";i:605;}i:1;a:6:{s:4:"name";s:12:"p1.3.2.kurs2";s:2:"id";i:5617;s:8:"category";i:0;s:7:"checked";i:1;s:13:"folderChecked";i:0;s:15:"parent_category";i:605;}i:2;a:6:{s:4:"name";s:12:"p1.3.2.kurs3";s:2:"id";i:5760;s:8:"category";i:0;s:7:"checked";i:1;s:13:"folderChecked";i:0;s:15:"parent_category";i:605;}i:3;a:6:{s:4:"name";s:12:"p1.3.2.kurs4";s:2:"id";i:5835;s:8:"category";i:0;s:7:"checked";i:1;s:13:"folderChecked";i:0;s:15:"parent_category";i:605;}i:4;a:6:{s:4:"name";s:12:"p1.3.2.kurs5";s:2:"id";i:5867;s:8:"category";i:0;s:7:"checked";i:1;s:13:"folderChecked";i:0;s:15:"parent_category";i:605;}i:5;a:6:{s:4:"name";s:12:"p1.3.2.kurs6";s:2:"id";i:6068;s:8:"category";i:0;s:7:"checked";i:1;s:13:"folderChecked";i:0;s:15:"parent_category";i:605;}i:6;a:6:{s:4:"name";s:12:"p1.3.2.kurs7";s:2:"id";i:6069;s:8:"category";i:0;s:7:"checked";i:1;s:13:"folderChecked";i:0;s:15:"parent_category";i:605;}i:7;a:6:{s:4:"name";s:12:"p1.3.2.kurs8";s:2:"id";i:6241;s:8:"category";i:0;s:7:"checked";i:1;s:13:"folderChecked";i:0;s:15:"parent_category";i:605;}i:8;a:6:{s:4:"name";s:12:"p1.3.2.kurs9";s:2:"id";i:6242;s:8:"category";i:0;s:7:"checked";i:1;s:13:"folderChecked";i:0;s:15:"parent_category";i:605;}i:9;a:6:{s:4:"name";s:13:"p1.3.2.kurs10";s:2:"id";i:6257;s:8:"category";i:0;s:7:"checked";i:1;s:13:"folderChecked";i:0;s:15:"parent_category";i:605;}i:10;a:6:{s:4:"name";s:13:"p1.3.2.kurs11";s:2:"id";i:6299;s:8:"category";i:0;s:7:"checked";i:1;s:13:"folderChecked";i:0;s:15:"parent_category";i:605;}i:11;a:6:{s:4:"name";s:13:"p1.3.2.kurs12";s:2:"id";i:6474;s:8:"category";i:0;s:7:"checked";i:1;s:13:"folderChecked";i:0;s:15:"parent_category";i:605;}i:12;a:6:{s:4:"name";s:13:"p1.3.2.kurs13";s:2:"id";i:6475;s:8:"category";i:0;s:7:"checked";i:1;s:13:"folderChecked";i:0;s:15:"parent_category";i:605;}i:13;a:6:{s:4:"name";s:13:"p1.3.2.kurs14";s:2:"id";i:6493;s:8:"category";i:0;s:7:"checked";i:1;s:13:"folderChecked";i:0;s:15:"parent_category";i:605;}i:14;a:6:{s:4:"name";s:13:"p1.3.2.kurs15";s:2:"id";i:6494;s:8:"category";i:0;s:7:"checked";i:1;s:13:"folderChecked";i:0;s:15:"parent_category";i:605;}i:15;a:6:{s:4:"name";s:13:"p1.3.2.kurs16";s:2:"id";i:6728;s:8:"category";i:0;s:7:"checked";i:1;s:13:"folderChecked";i:0;s:15:"parent_category";i:605;}}}i:2;a:8:{s:2:"id";i:606;s:4:"name";s:6:"p1.3.3";s:15:"parent_category";i:602;s:7:"checked";i:1;s:13:"folderChecked";i:1;s:5:"buyed";i:0;s:8:"category";i:1;s:8:"children";a:3:{i:0;a:6:{s:4:"name";s:12:"p1.3.3.kurs1";s:2:"id";i:5680;s:8:"category";i:0;s:7:"checked";i:1;s:13:"folderChecked";i:0;s:15:"parent_category";i:606;}i:1;a:6:{s:4:"name";s:12:"p1.3.3.kurs2";s:2:"id";i:5732;s:8:"category";i:0;s:7:"checked";i:1;s:13:"folderChecked";i:0;s:15:"parent_category";i:606;}i:2;a:6:{s:4:"name";s:12:"p1.3.3.kurs3";s:2:"id";i:6301;s:8:"category";i:0;s:7:"checked";i:1;s:13:"folderChecked";i:0;s:15:"parent_category";i:606;}}}}}}}}';


	
	$array = unserialize($fullWithoutOneArray);
	//dnl($array);	
    return $array;

	}
    function setPath($path, &$array = array(), $value = null)
	{
		//$path = explode('.', $path); //if needed
		$temp = &$array;

		foreach ($path as $key) {
			$temp = &$temp[$key];
		}
		$temp = $value;
	}
	function array_search_path($needle, array $haystack, array $path = [])
	{
		foreach ($haystack as $key => $value) {
			$currentPath = array_merge($path, [$key]);
			if (is_array($value) && $result = array_search_path($needle, $value, $currentPath)) {
				return $result;
			} else if ($value == $needle && $key == "id") {
				return $currentPath;
			}
		}
		return false;
	}
	function getChildrenFor($ary, $id)
	{
		$results = array();
		$children = array();
		foreach ($ary as $el) {
			if ($el['parent_category'] == $id) {
				$results[] = $el;
			}
			if (isset($el['children'])) {
				if (count($el['children']) > 0 && ($children = getChildrenFor($el['children'], $id)) !== FALSE) {
					if (is_array($children)) {
						$results = array_merge($results, $children);
					}
				}
			}
		}

		return count($results) > 0 ? $results : $id;
	}

	function my_walk_recursive(array $array, $path = null)
	{
		foreach ($array as $k => $v) {
			if (!is_array($v)) {

				// $fullpath = $path . $k;

				// echo "Link to $fullpath\n";

				if ($k == "checked" && $v == false) {
					var_dump($path);
				}
			} else {
				// directory node -- recurse
				my_walk_recursive($v, $path . '/' . $k);
			}
		}
	}
function d($data)
{
	if (is_null($data)) {
		$str = "<i>NULL</i>";
	} elseif ($data == "") {
		$str = "<i>Empty</i>";
	} elseif (is_array($data)) {
		if (count($data) == 0) {
			$str = "<i>Empty array.</i>";
		} else {
			$str = "<table style=\"border-bottom:0px solid #000;\" cellpadding=\"0\" cellspacing=\"0\">";
			foreach ($data as $key => $value) {
				$str .= "<tr><td style=\"background-color:#008B8B; color:#FFF;border:1px solid #000;\">" . $key . "</td><td style=\"border:1px solid #000;\">" . d($value) . "</td></tr>";
			}
			$str .= "</table>";
		}
	} elseif (is_resource($data)) {
		while ($arr = mysql_fetch_array($data)) {
			$data_array[] = $arr;
		}
		$str = d($data_array);
	} elseif (is_object($data)) {
		$str = d(get_object_vars($data));
	} elseif (is_bool($data)) {
		$str = "<i>" . ($data ? "True" : "False") . "</i>";
	} else {
		$str = $data;
		$str = preg_replace("/\n/", "<br>\n", $str);
	}
	return $str;
}

function dnl($data)
{
	echo d($data) . "<br>\n";
}