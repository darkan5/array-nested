<?php


    mycourses();
    mycourses(["407"],"remove");

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

    function mycourses($checkedIds = ["4242"], $action = "add",$request = 0, $requestTest = false)
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
		$all_categories_tree = getRecurringCategories(0);

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

	//$serialized = 'a:2:{i:0;a:8:{s:2:"id";i:467;s:4:"name";s:2:"p1";s:15:"parent_category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;s:5:"buyed";i:0;s:8:"category";i:1;s:8:"children";a:3:{i:0;a:8:{s:2:"id";i:407;s:4:"name";s:4:"p1.1";s:15:"parent_category";i:467;s:7:"checked";i:0;s:13:"folderChecked";i:0;s:5:"buyed";i:0;s:8:"category";i:1;s:8:"children";a:3:{i:0;a:8:{s:2:"id";i:408;s:4:"name";s:6:"p1.1.1";s:15:"parent_category";i:407;s:7:"checked";i:0;s:13:"folderChecked";i:0;s:5:"buyed";i:0;s:8:"category";i:1;s:8:"children";a:1:{i:0;a:3:{i:0;O:8:"stdClass":5:{s:2:"id";i:4242;s:4:"name";s:12:"p1.1.1.kurs1";s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;}i:1;O:8:"stdClass":5:{s:2:"id";i:4245;s:4:"name";s:12:"p1.1.1.kurs2";s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;}i:2;O:8:"stdClass":5:{s:2:"id";i:5846;s:4:"name";s:12:"p1.1.1.kurs3";s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;}}}}i:1;a:8:{s:2:"id";i:415;s:4:"name";s:6:"p1.1.2";s:15:"parent_category";i:407;s:7:"checked";i:0;s:13:"folderChecked";i:0;s:5:"buyed";i:0;s:8:"category";i:1;s:8:"children";a:1:{i:0;a:3:{i:0;O:8:"stdClass":5:{s:2:"id";i:6149;s:4:"name";s:12:"p1.1.2.kurs1";s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;}i:1;O:8:"stdClass":5:{s:2:"id";i:6276;s:4:"name";s:12:"p1.1.2.kurs2";s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;}i:2;O:8:"stdClass":5:{s:2:"id";i:6662;s:4:"name";s:12:"p1.1.2.kurs3";s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;}}}}i:2;a:8:{s:2:"id";i:416;s:4:"name";s:6:"p1.1.3";s:15:"parent_category";i:407;s:7:"checked";i:0;s:13:"folderChecked";i:0;s:5:"buyed";i:0;s:8:"category";i:1;s:8:"children";a:1:{i:0;a:3:{i:0;O:8:"stdClass":5:{s:2:"id";i:6075;s:4:"name";s:12:"p1.1.3.kurs1";s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;}i:1;O:8:"stdClass":5:{s:2:"id";i:6277;s:4:"name";s:12:"p1.1.3.kurs2";s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;}i:2;O:8:"stdClass":5:{s:2:"id";i:6663;s:4:"name";s:12:"p1.1.3.kurs3";s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;}}}}}}i:1;a:8:{s:2:"id";i:471;s:4:"name";s:4:"p1.2";s:15:"parent_category";i:467;s:7:"checked";i:0;s:13:"folderChecked";i:0;s:5:"buyed";i:0;s:8:"category";i:1;s:8:"children";a:2:{i:0;a:8:{s:2:"id";i:473;s:4:"name";s:6:"p1.2.1";s:15:"parent_category";i:471;s:7:"checked";i:0;s:13:"folderChecked";i:0;s:5:"buyed";i:0;s:8:"category";i:1;s:8:"children";a:2:{i:0;a:8:{s:2:"id";i:533;s:4:"name";s:8:"p1.2.1.1";s:15:"parent_category";i:473;s:7:"checked";i:0;s:13:"folderChecked";i:0;s:5:"buyed";i:0;s:8:"category";i:1;s:8:"children";a:1:{i:0;a:3:{i:0;O:8:"stdClass":5:{s:2:"id";i:5489;s:4:"name";s:14:"p1.2.1.1.kurs1";s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;}i:1;O:8:"stdClass":5:{s:2:"id";i:6082;s:4:"name";s:14:"p1.2.1.1.kurs2";s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;}i:2;O:8:"stdClass":5:{s:2:"id";i:6669;s:4:"name";s:14:"p1.2.1.1.kurs3";s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;}}}}i:1;a:8:{s:2:"id";i:534;s:4:"name";s:8:"p1.2.1.2";s:15:"parent_category";i:473;s:7:"checked";i:0;s:13:"folderChecked";i:0;s:5:"buyed";i:0;s:8:"category";i:1;s:8:"children";a:1:{i:0;a:3:{i:0;O:8:"stdClass":5:{s:2:"id";i:6207;s:4:"name";s:14:"p1.2.1.2.kurs1";s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;}i:1;O:8:"stdClass":5:{s:2:"id";i:6208;s:4:"name";s:14:"p1.2.1.2.kurs2";s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;}i:2;O:8:"stdClass":5:{s:2:"id";i:6670;s:4:"name";s:14:"p1.2.1.2.kurs3";s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;}}}}}}i:1;a:8:{s:2:"id";i:527;s:4:"name";s:6:"p1.2.2";s:15:"parent_category";i:471;s:7:"checked";i:0;s:13:"folderChecked";i:0;s:5:"buyed";i:0;s:8:"category";i:1;s:8:"children";a:1:{i:0;a:3:{i:0;O:8:"stdClass":5:{s:2:"id";i:4926;s:4:"name";s:12:"p1.2.2.kurs1";s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;}i:1;O:8:"stdClass":5:{s:2:"id";i:6469;s:4:"name";s:12:"p1.2.2.kurs2";s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;}i:2;O:8:"stdClass":5:{s:2:"id";i:6491;s:4:"name";s:12:"p1.2.2.kurs3";s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;}}}}}}i:2;a:8:{s:2:"id";i:602;s:4:"name";s:4:"p1.3";s:15:"parent_category";i:467;s:7:"checked";i:0;s:13:"folderChecked";i:0;s:5:"buyed";i:0;s:8:"category";i:1;s:8:"children";a:3:{i:0;a:8:{s:2:"id";i:604;s:4:"name";s:6:"p1.3.1";s:15:"parent_category";i:602;s:7:"checked";i:0;s:13:"folderChecked";i:0;s:5:"buyed";i:0;s:8:"category";i:1;s:8:"children";a:3:{i:0;a:8:{s:2:"id";i:687;s:4:"name";s:8:"p1.3.1.1";s:15:"parent_category";i:604;s:7:"checked";i:0;s:13:"folderChecked";i:0;s:5:"buyed";i:0;s:8:"category";i:1;s:8:"children";a:1:{i:0;a:3:{i:0;O:8:"stdClass":5:{s:2:"id";i:5664;s:4:"name";s:14:"p1.3.1.1.kurs1";s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;}i:1;O:8:"stdClass":5:{s:2:"id";i:6255;s:4:"name";s:14:"p1.3.1.1.kurs2";s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;}i:2;O:8:"stdClass":5:{s:2:"id";i:6675;s:4:"name";s:14:"p1.3.1.1.kurs3";s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;}}}}i:1;a:8:{s:2:"id";i:688;s:4:"name";s:8:"p1.3.1.2";s:15:"parent_category";i:604;s:7:"checked";i:0;s:13:"folderChecked";i:0;s:5:"buyed";i:0;s:8:"category";i:1;s:8:"children";a:1:{i:0;a:17:{i:0;O:8:"stdClass":5:{s:2:"id";i:4981;s:4:"name";s:14:"p1.3.1.2.kurs1";s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;}i:1;O:8:"stdClass":5:{s:2:"id";i:4984;s:4:"name";s:14:"p1.3.1.2.kurs2";s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;}i:2;O:8:"stdClass":5:{s:2:"id";i:5007;s:4:"name";s:14:"p1.3.1.2.kurs3";s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;}i:3;O:8:"stdClass":5:{s:2:"id";i:5010;s:4:"name";s:14:"p1.3.1.2.kurs4";s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;}i:4;O:8:"stdClass":5:{s:2:"id";i:5012;s:4:"name";s:14:"p1.3.1.2.kurs5";s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;}i:5;O:8:"stdClass":5:{s:2:"id";i:5668;s:4:"name";s:14:"p1.3.1.2.kurs6";s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;}i:6;O:8:"stdClass":5:{s:2:"id";i:5727;s:4:"name";s:14:"p1.3.1.2.kurs7";s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;}i:7;O:8:"stdClass":5:{s:2:"id";i:5728;s:4:"name";s:14:"p1.3.1.2.kurs8";s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;}i:8;O:8:"stdClass":5:{s:2:"id";i:5766;s:4:"name";s:14:"p1.3.1.2.kurs9";s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;}i:9;O:8:"stdClass":5:{s:2:"id";i:6089;s:4:"name";s:15:"p1.3.1.2.kurs10";s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;}i:10;O:8:"stdClass":5:{s:2:"id";i:6145;s:4:"name";s:15:"p1.3.1.2.kurs11";s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;}i:11;O:8:"stdClass":5:{s:2:"id";i:6256;s:4:"name";s:15:"p1.3.1.2.kurs12";s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;}i:12;O:8:"stdClass":5:{s:2:"id";i:6314;s:4:"name";s:15:"p1.3.1.2.kurs13";s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;}i:13;O:8:"stdClass":5:{s:2:"id";i:6349;s:4:"name";s:15:"p1.3.1.2.kurs14";s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;}i:14;O:8:"stdClass":5:{s:2:"id";i:6535;s:4:"name";s:15:"p1.3.1.2.kurs15";s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;}i:15;O:8:"stdClass":5:{s:2:"id";i:6536;s:4:"name";s:15:"p1.3.1.2.kurs16";s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;}i:16;O:8:"stdClass":5:{s:2:"id";i:6676;s:4:"name";s:15:"p1.3.1.2.kurs17";s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;}}}}i:2;a:8:{s:2:"id";i:689;s:4:"name";s:8:"p1.3.1.3";s:15:"parent_category";i:604;s:7:"checked";i:0;s:13:"folderChecked";i:0;s:5:"buyed";i:0;s:8:"category";i:1;s:8:"children";a:1:{i:0;a:3:{i:0;O:8:"stdClass":5:{s:2:"id";i:4986;s:4:"name";s:14:"p1.3.1.3.kurs1";s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;}i:1;O:8:"stdClass":5:{s:2:"id";i:6350;s:4:"name";s:14:"p1.3.1.3.kurs2";s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;}i:2;O:8:"stdClass":5:{s:2:"id";i:6677;s:4:"name";s:14:"p1.3.1.3.kurs3";s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;}}}}}}i:1;a:8:{s:2:"id";i:605;s:4:"name";s:6:"p1.3.2";s:15:"parent_category";i:602;s:7:"checked";i:0;s:13:"folderChecked";i:0;s:5:"buyed";i:0;s:8:"category";i:1;s:8:"children";a:1:{i:0;a:16:{i:0;O:8:"stdClass":5:{s:2:"id";i:5614;s:4:"name";s:12:"p1.3.2.kurs1";s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;}i:1;O:8:"stdClass":5:{s:2:"id";i:5617;s:4:"name";s:12:"p1.3.2.kurs2";s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;}i:2;O:8:"stdClass":5:{s:2:"id";i:5760;s:4:"name";s:12:"p1.3.2.kurs3";s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;}i:3;O:8:"stdClass":5:{s:2:"id";i:5835;s:4:"name";s:12:"p1.3.2.kurs4";s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;}i:4;O:8:"stdClass":5:{s:2:"id";i:5867;s:4:"name";s:12:"p1.3.2.kurs5";s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;}i:5;O:8:"stdClass":5:{s:2:"id";i:6068;s:4:"name";s:12:"p1.3.2.kurs6";s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;}i:6;O:8:"stdClass":5:{s:2:"id";i:6069;s:4:"name";s:12:"p1.3.2.kurs7";s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;}i:7;O:8:"stdClass":5:{s:2:"id";i:6241;s:4:"name";s:12:"p1.3.2.kurs8";s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;}i:8;O:8:"stdClass":5:{s:2:"id";i:6242;s:4:"name";s:12:"p1.3.2.kurs9";s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;}i:9;O:8:"stdClass":5:{s:2:"id";i:6257;s:4:"name";s:13:"p1.3.2.kurs10";s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;}i:10;O:8:"stdClass":5:{s:2:"id";i:6299;s:4:"name";s:13:"p1.3.2.kurs11";s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;}i:11;O:8:"stdClass":5:{s:2:"id";i:6474;s:4:"name";s:13:"p1.3.2.kurs12";s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;}i:12;O:8:"stdClass":5:{s:2:"id";i:6475;s:4:"name";s:13:"p1.3.2.kurs13";s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;}i:13;O:8:"stdClass":5:{s:2:"id";i:6493;s:4:"name";s:13:"p1.3.2.kurs14";s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;}i:14;O:8:"stdClass":5:{s:2:"id";i:6494;s:4:"name";s:13:"p1.3.2.kurs15";s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;}i:15;O:8:"stdClass":5:{s:2:"id";i:6728;s:4:"name";s:13:"p1.3.2.kurs16";s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;}}}}i:2;a:8:{s:2:"id";i:606;s:4:"name";s:6:"p1.3.3";s:15:"parent_category";i:602;s:7:"checked";i:0;s:13:"folderChecked";i:0;s:5:"buyed";i:0;s:8:"category";i:1;s:8:"children";a:1:{i:0;a:34:{i:0;O:8:"stdClass":5:{s:2:"id";i:4994;s:4:"name";s:12:"p1.3.3.kurs1";s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;}i:1;O:8:"stdClass":5:{s:2:"id";i:4997;s:4:"name";s:12:"p1.3.3.kurs2";s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;}i:2;O:8:"stdClass":5:{s:2:"id";i:4999;s:4:"name";s:12:"p1.3.3.kurs3";s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;}i:3;O:8:"stdClass":5:{s:2:"id";i:5001;s:4:"name";s:12:"p1.3.3.kurs4";s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;}i:4;O:8:"stdClass":5:{s:2:"id";i:5529;s:4:"name";s:12:"p1.3.3.kurs5";s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;}i:5;O:8:"stdClass":5:{s:2:"id";i:5532;s:4:"name";s:12:"p1.3.3.kurs6";s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;}i:6;O:8:"stdClass":5:{s:2:"id";i:5534;s:4:"name";s:12:"p1.3.3.kurs7";s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;}i:7;O:8:"stdClass":5:{s:2:"id";i:5679;s:4:"name";s:12:"p1.3.3.kurs8";s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;}i:8;O:8:"stdClass":5:{s:2:"id";i:5680;s:4:"name";s:12:"p1.3.3.kurs9";s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;}i:9;O:8:"stdClass":5:{s:2:"id";i:5731;s:4:"name";s:13:"p1.3.3.kurs10";s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;}i:10;O:8:"stdClass":5:{s:2:"id";i:5732;s:4:"name";s:13:"p1.3.3.kurs11";s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;}i:11;O:8:"stdClass":5:{s:2:"id";i:5733;s:4:"name";s:13:"p1.3.3.kurs12";s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;}i:12;O:8:"stdClass":5:{s:2:"id";i:5734;s:4:"name";s:13:"p1.3.3.kurs13";s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;}i:13;O:8:"stdClass":5:{s:2:"id";i:5735;s:4:"name";s:13:"p1.3.3.kurs14";s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;}i:14;O:8:"stdClass":5:{s:2:"id";i:5770;s:4:"name";s:13:"p1.3.3.kurs15";s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;}i:15;O:8:"stdClass":5:{s:2:"id";i:5775;s:4:"name";s:13:"p1.3.3.kurs16";s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;}i:16;O:8:"stdClass":5:{s:2:"id";i:5838;s:4:"name";s:13:"p1.3.3.kurs17";s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;}i:17;O:8:"stdClass":5:{s:2:"id";i:5869;s:4:"name";s:13:"p1.3.3.kurs18";s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;}i:18;O:8:"stdClass":5:{s:2:"id";i:6147;s:4:"name";s:13:"p1.3.3.kurs19";s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;}i:19;O:8:"stdClass":5:{s:2:"id";i:6227;s:4:"name";s:13:"p1.3.3.kurs20";s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;}i:20;O:8:"stdClass":5:{s:2:"id";i:6243;s:4:"name";s:13:"p1.3.3.kurs21";s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;}i:21;O:8:"stdClass":5:{s:2:"id";i:6245;s:4:"name";s:13:"p1.3.3.kurs22";s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;}i:22;O:8:"stdClass":5:{s:2:"id";i:6273;s:4:"name";s:13:"p1.3.3.kurs23";s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;}i:23;O:8:"stdClass":5:{s:2:"id";i:6300;s:4:"name";s:13:"p1.3.3.kurs24";s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;}i:24;O:8:"stdClass":5:{s:2:"id";i:6301;s:4:"name";s:13:"p1.3.3.kurs25";s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;}i:25;O:8:"stdClass":5:{s:2:"id";i:6316;s:4:"name";s:13:"p1.3.3.kurs26";s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;}i:26;O:8:"stdClass":5:{s:2:"id";i:6372;s:4:"name";s:13:"p1.3.3.kurs27";s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;}i:27;O:8:"stdClass":5:{s:2:"id";i:6390;s:4:"name";s:13:"p1.3.3.kurs28";s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;}i:28;O:8:"stdClass":5:{s:2:"id";i:6391;s:4:"name";s:13:"p1.3.3.kurs29";s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;}i:29;O:8:"stdClass":5:{s:2:"id";i:6392;s:4:"name";s:13:"p1.3.3.kurs30";s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;}i:30;O:8:"stdClass":5:{s:2:"id";i:6514;s:4:"name";s:13:"p1.3.3.kurs31";s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;}i:31;O:8:"stdClass":5:{s:2:"id";i:6532;s:4:"name";s:13:"p1.3.3.kurs32";s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;}i:32;O:8:"stdClass":5:{s:2:"id";i:6537;s:4:"name";s:13:"p1.3.3.kurs33";s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;}i:33;O:8:"stdClass":5:{s:2:"id";i:6538;s:4:"name";s:13:"p1.3.3.kurs34";s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;}}}}}}}}i:1;a:8:{s:2:"id";i:469;s:4:"name";s:2:"p2";s:15:"parent_category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;s:5:"buyed";i:0;s:8:"category";i:1;s:8:"children";a:3:{i:0;a:8:{s:2:"id";i:483;s:4:"name";s:4:"p2.1";s:15:"parent_category";i:469;s:7:"checked";i:0;s:13:"folderChecked";i:0;s:5:"buyed";i:0;s:8:"category";i:1;s:8:"children";a:2:{i:0;a:8:{s:2:"id";i:547;s:4:"name";s:6:"p2.1.1";s:15:"parent_category";i:483;s:7:"checked";i:0;s:13:"folderChecked";i:0;s:5:"buyed";i:0;s:8:"category";i:1;s:8:"children";a:1:{i:0;a:11:{i:0;O:8:"stdClass":5:{s:2:"id";i:4536;s:4:"name";s:12:"p2.1.1.kurs1";s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;}i:1;O:8:"stdClass":5:{s:2:"id";i:4538;s:4:"name";s:12:"p2.1.1.kurs2";s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;}i:2;O:8:"stdClass":5:{s:2:"id";i:4540;s:4:"name";s:12:"p2.1.1.kurs3";s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;}i:3;O:8:"stdClass":5:{s:2:"id";i:4541;s:4:"name";s:12:"p2.1.1.kurs4";s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;}i:4;O:8:"stdClass":5:{s:2:"id";i:4543;s:4:"name";s:12:"p2.1.1.kurs5";s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;}i:5;O:8:"stdClass":5:{s:2:"id";i:4544;s:4:"name";s:12:"p2.1.1.kurs6";s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;}i:6;O:8:"stdClass":5:{s:2:"id";i:5274;s:4:"name";s:12:"p2.1.1.kurs7";s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;}i:7;O:8:"stdClass":5:{s:2:"id";i:5700;s:4:"name";s:12:"p2.1.1.kurs8";s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;}i:8;O:8:"stdClass":5:{s:2:"id";i:6351;s:4:"name";s:12:"p2.1.1.kurs9";s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;}i:9;O:8:"stdClass":5:{s:2:"id";i:6381;s:4:"name";s:13:"p2.1.1.kurs10";s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;}i:10;O:8:"stdClass":5:{s:2:"id";i:6550;s:4:"name";s:13:"p2.1.1.kurs11";s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;}}}}i:1;a:8:{s:2:"id";i:548;s:4:"name";s:6:"p2.1.2";s:15:"parent_category";i:483;s:7:"checked";i:0;s:13:"folderChecked";i:0;s:5:"buyed";i:0;s:8:"category";i:1;s:8:"children";a:1:{i:0;a:12:{i:0;O:8:"stdClass":5:{s:2:"id";i:4547;s:4:"name";s:12:"p2.1.2.kurs1";s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;}i:1;O:8:"stdClass":5:{s:2:"id";i:4548;s:4:"name";s:12:"p2.1.2.kurs2";s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;}i:2;O:8:"stdClass":5:{s:2:"id";i:4549;s:4:"name";s:12:"p2.1.2.kurs3";s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;}i:3;O:8:"stdClass":5:{s:2:"id";i:4550;s:4:"name";s:12:"p2.1.2.kurs4";s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;}i:4;O:8:"stdClass":5:{s:2:"id";i:4551;s:4:"name";s:12:"p2.1.2.kurs5";s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;}i:5;O:8:"stdClass":5:{s:2:"id";i:4552;s:4:"name";s:12:"p2.1.2.kurs6";s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;}i:6;O:8:"stdClass":5:{s:2:"id";i:5275;s:4:"name";s:12:"p2.1.2.kurs7";s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;}i:7;O:8:"stdClass":5:{s:2:"id";i:5702;s:4:"name";s:12:"p2.1.2.kurs8";s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;}i:8;O:8:"stdClass":5:{s:2:"id";i:5872;s:4:"name";s:12:"p2.1.2.kurs9";s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;}i:9;O:8:"stdClass":5:{s:2:"id";i:6352;s:4:"name";s:13:"p2.1.2.kurs10";s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;}i:10;O:8:"stdClass":5:{s:2:"id";i:6382;s:4:"name";s:13:"p2.1.2.kurs11";s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;}i:11;O:8:"stdClass":5:{s:2:"id";i:6551;s:4:"name";s:13:"p2.1.2.kurs12";s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;}}}}}}i:1;a:8:{s:2:"id";i:484;s:4:"name";s:4:"p2.2";s:15:"parent_category";i:469;s:7:"checked";i:0;s:13:"folderChecked";i:0;s:5:"buyed";i:0;s:8:"category";i:1;s:8:"children";a:2:{i:0;a:8:{s:2:"id";i:549;s:4:"name";s:6:"p2.2.1";s:15:"parent_category";i:484;s:7:"checked";i:0;s:13:"folderChecked";i:0;s:5:"buyed";i:0;s:8:"category";i:1;s:8:"children";a:1:{i:0;a:12:{i:0;O:8:"stdClass":5:{s:2:"id";i:4556;s:4:"name";s:12:"p2.2.1.kurs1";s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;}i:1;O:8:"stdClass":5:{s:2:"id";i:4557;s:4:"name";s:12:"p2.2.1.kurs2";s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;}i:2;O:8:"stdClass":5:{s:2:"id";i:4562;s:4:"name";s:12:"p2.2.1.kurs3";s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;}i:3;O:8:"stdClass":5:{s:2:"id";i:4563;s:4:"name";s:12:"p2.2.1.kurs4";s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;}i:4;O:8:"stdClass":5:{s:2:"id";i:4564;s:4:"name";s:12:"p2.2.1.kurs5";s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;}i:5;O:8:"stdClass":5:{s:2:"id";i:4565;s:4:"name";s:12:"p2.2.1.kurs6";s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;}i:6;O:8:"stdClass":5:{s:2:"id";i:5223;s:4:"name";s:12:"p2.2.1.kurs7";s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;}i:7;O:8:"stdClass":5:{s:2:"id";i:5325;s:4:"name";s:12:"p2.2.1.kurs8";s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;}i:8;O:8:"stdClass":5:{s:2:"id";i:5326;s:4:"name";s:12:"p2.2.1.kurs9";s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;}i:9;O:8:"stdClass":5:{s:2:"id";i:5873;s:4:"name";s:13:"p2.2.1.kurs10";s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;}i:10;O:8:"stdClass":5:{s:2:"id";i:6393;s:4:"name";s:13:"p2.2.1.kurs11";s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;}i:11;O:8:"stdClass":5:{s:2:"id";i:6552;s:4:"name";s:13:"p2.2.1.kurs12";s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;}}}}i:1;a:8:{s:2:"id";i:550;s:4:"name";s:6:"p2.2.2";s:15:"parent_category";i:484;s:7:"checked";i:0;s:13:"folderChecked";i:0;s:5:"buyed";i:0;s:8:"category";i:1;s:8:"children";a:1:{i:0;a:11:{i:0;O:8:"stdClass":5:{s:2:"id";i:4558;s:4:"name";s:12:"p2.2.2.kurs1";s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;}i:1;O:8:"stdClass":5:{s:2:"id";i:4559;s:4:"name";s:12:"p2.2.2.kurs2";s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;}i:2;O:8:"stdClass":5:{s:2:"id";i:4560;s:4:"name";s:12:"p2.2.2.kurs3";s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;}i:3;O:8:"stdClass":5:{s:2:"id";i:4566;s:4:"name";s:12:"p2.2.2.kurs4";s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;}i:4;O:8:"stdClass":5:{s:2:"id";i:4567;s:4:"name";s:12:"p2.2.2.kurs5";s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;}i:5;O:8:"stdClass":5:{s:2:"id";i:4568;s:4:"name";s:12:"p2.2.2.kurs6";s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;}i:6;O:8:"stdClass":5:{s:2:"id";i:4569;s:4:"name";s:12:"p2.2.2.kurs7";s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;}i:7;O:8:"stdClass":5:{s:2:"id";i:5327;s:4:"name";s:12:"p2.2.2.kurs8";s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;}i:8;O:8:"stdClass":5:{s:2:"id";i:5874;s:4:"name";s:12:"p2.2.2.kurs9";s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;}i:9;O:8:"stdClass":5:{s:2:"id";i:6394;s:4:"name";s:13:"p2.2.2.kurs10";s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;}i:10;O:8:"stdClass":5:{s:2:"id";i:6566;s:4:"name";s:13:"p2.2.2.kurs11";s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;}}}}}}i:2;a:8:{s:2:"id";i:485;s:4:"name";s:4:"p2.3";s:15:"parent_category";i:469;s:7:"checked";i:0;s:13:"folderChecked";i:0;s:5:"buyed";i:0;s:8:"category";i:1;s:8:"children";a:2:{i:0;a:8:{s:2:"id";i:551;s:4:"name";s:6:"p2.3.1";s:15:"parent_category";i:485;s:7:"checked";i:0;s:13:"folderChecked";i:0;s:5:"buyed";i:0;s:8:"category";i:1;s:8:"children";a:1:{i:0;a:10:{i:0;O:8:"stdClass":5:{s:2:"id";i:4572;s:4:"name";s:12:"p2.3.1.kurs1";s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;}i:1;O:8:"stdClass":5:{s:2:"id";i:4573;s:4:"name";s:12:"p2.3.1.kurs2";s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;}i:2;O:8:"stdClass":5:{s:2:"id";i:4574;s:4:"name";s:12:"p2.3.1.kurs3";s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;}i:3;O:8:"stdClass":5:{s:2:"id";i:4575;s:4:"name";s:12:"p2.3.1.kurs4";s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;}i:4;O:8:"stdClass":5:{s:2:"id";i:4576;s:4:"name";s:12:"p2.3.1.kurs5";s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;}i:5;O:8:"stdClass":5:{s:2:"id";i:4577;s:4:"name";s:12:"p2.3.1.kurs6";s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;}i:6;O:8:"stdClass":5:{s:2:"id";i:5328;s:4:"name";s:12:"p2.3.1.kurs7";s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;}i:7;O:8:"stdClass":5:{s:2:"id";i:5498;s:4:"name";s:12:"p2.3.1.kurs8";s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;}i:8;O:8:"stdClass":5:{s:2:"id";i:6395;s:4:"name";s:12:"p2.3.1.kurs9";s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;}i:9;O:8:"stdClass":5:{s:2:"id";i:6567;s:4:"name";s:13:"p2.3.1.kurs10";s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;}}}}i:1;a:8:{s:2:"id";i:552;s:4:"name";s:6:"p2.3.2";s:15:"parent_category";i:485;s:7:"checked";i:0;s:13:"folderChecked";i:0;s:5:"buyed";i:0;s:8:"category";i:1;s:8:"children";a:1:{i:0;a:11:{i:0;O:8:"stdClass":5:{s:2:"id";i:4578;s:4:"name";s:12:"p2.3.2.kurs1";s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;}i:1;O:8:"stdClass":5:{s:2:"id";i:4580;s:4:"name";s:12:"p2.3.2.kurs2";s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;}i:2;O:8:"stdClass":5:{s:2:"id";i:4581;s:4:"name";s:12:"p2.3.2.kurs3";s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;}i:3;O:8:"stdClass":5:{s:2:"id";i:4582;s:4:"name";s:12:"p2.3.2.kurs4";s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;}i:4;O:8:"stdClass":5:{s:2:"id";i:4583;s:4:"name";s:12:"p2.3.2.kurs5";s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;}i:5;O:8:"stdClass":5:{s:2:"id";i:4584;s:4:"name";s:12:"p2.3.2.kurs6";s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;}i:6;O:8:"stdClass":5:{s:2:"id";i:4585;s:4:"name";s:12:"p2.3.2.kurs7";s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;}i:7;O:8:"stdClass":5:{s:2:"id";i:5776;s:4:"name";s:12:"p2.3.2.kurs8";s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;}i:8;O:8:"stdClass":5:{s:2:"id";i:5875;s:4:"name";s:12:"p2.3.2.kurs9";s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;}i:9;O:8:"stdClass":5:{s:2:"id";i:6396;s:4:"name";s:13:"p2.3.2.kurs10";s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;}i:10;O:8:"stdClass":5:{s:2:"id";i:6576;s:4:"name";s:13:"p2.3.2.kurs11";s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;}}}}}}}}}';
	$serialized =
	'a:1:{i:0;a:8:{s:2:"id";i:467;s:4:"name";s:2:"p1";s:15:"parent_category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:1;s:5:"buyed";i:0;s:8:"category";i:1;s:8:"children";a:3:{i:0;a:8:{s:2:"id";i:407;s:4:"name";s:4:"p1.1";s:15:"parent_category";i:467;s:7:"checked";i:0;s:13:"folderChecked";i:1;s:5:"buyed";i:0;s:8:"category";i:1;s:8:"children";a:3:{i:0;a:8:{s:2:"id";i:408;s:4:"name";s:6:"p1.1.1";s:15:"parent_category";i:407;s:7:"checked";i:0;s:13:"folderChecked";i:1;s:5:"buyed";i:0;s:8:"category";i:1;s:8:"children";a:3:{i:0;a:5:{s:4:"name";s:12:"p1.1.1.kurs1";s:2:"id";i:4242;s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;}i:1;a:5:{s:4:"name";s:12:"p1.1.1.kurs2";s:2:"id";i:4245;s:8:"category";i:0;s:7:"checked";i:1;s:13:"folderChecked";i:0;}i:2;a:5:{s:4:"name";s:12:"p1.1.1.kurs3";s:2:"id";i:5846;s:8:"category";i:0;s:7:"checked";i:1;s:13:"folderChecked";i:0;}}}i:1;a:8:{s:2:"id";i:415;s:4:"name";s:6:"p1.1.2";s:15:"parent_category";i:407;s:7:"checked";i:1;s:13:"folderChecked";i:1;s:5:"buyed";i:0;s:8:"category";i:1;s:8:"children";a:3:{i:0;a:5:{s:4:"name";s:12:"p1.1.2.kurs1";s:2:"id";i:6149;s:8:"category";i:0;s:7:"checked";i:1;s:13:"folderChecked";i:0;}i:1;a:5:{s:4:"name";s:12:"p1.1.2.kurs2";s:2:"id";i:6276;s:8:"category";i:0;s:7:"checked";i:1;s:13:"folderChecked";i:0;}i:2;a:5:{s:4:"name";s:12:"p1.1.2.kurs3";s:2:"id";i:6662;s:8:"category";i:0;s:7:"checked";i:1;s:13:"folderChecked";i:0;}}}i:2;a:8:{s:2:"id";i:416;s:4:"name";s:6:"p1.1.3";s:15:"parent_category";i:407;s:7:"checked";i:1;s:13:"folderChecked";i:1;s:5:"buyed";i:0;s:8:"category";i:1;s:8:"children";a:3:{i:0;a:5:{s:4:"name";s:12:"p1.1.3.kurs1";s:2:"id";i:6075;s:8:"category";i:0;s:7:"checked";i:1;s:13:"folderChecked";i:0;}i:1;a:5:{s:4:"name";s:12:"p1.1.3.kurs2";s:2:"id";i:6277;s:8:"category";i:0;s:7:"checked";i:1;s:13:"folderChecked";i:0;}i:2;a:5:{s:4:"name";s:12:"p1.1.3.kurs3";s:2:"id";i:6663;s:8:"category";i:0;s:7:"checked";i:1;s:13:"folderChecked";i:0;}}}}}i:1;a:8:{s:2:"id";i:471;s:4:"name";s:4:"p1.2";s:15:"parent_category";i:467;s:7:"checked";i:1;s:13:"folderChecked";i:1;s:5:"buyed";i:0;s:8:"category";i:1;s:8:"children";a:2:{i:0;a:8:{s:2:"id";i:473;s:4:"name";s:6:"p1.2.1";s:15:"parent_category";i:471;s:7:"checked";i:1;s:13:"folderChecked";i:1;s:5:"buyed";i:0;s:8:"category";i:1;s:8:"children";a:2:{i:0;a:8:{s:2:"id";i:533;s:4:"name";s:8:"p1.2.1.1";s:15:"parent_category";i:473;s:7:"checked";i:1;s:13:"folderChecked";i:1;s:5:"buyed";i:0;s:8:"category";i:1;s:8:"children";a:3:{i:0;a:5:{s:4:"name";s:14:"p1.2.1.1.kurs1";s:2:"id";i:5489;s:8:"category";i:0;s:7:"checked";i:1;s:13:"folderChecked";i:0;}i:1;a:5:{s:4:"name";s:14:"p1.2.1.1.kurs2";s:2:"id";i:6082;s:8:"category";i:0;s:7:"checked";i:1;s:13:"folderChecked";i:0;}i:2;a:5:{s:4:"name";s:14:"p1.2.1.1.kurs3";s:2:"id";i:6669;s:8:"category";i:0;s:7:"checked";i:1;s:13:"folderChecked";i:0;}}}i:1;a:8:{s:2:"id";i:534;s:4:"name";s:8:"p1.2.1.2";s:15:"parent_category";i:473;s:7:"checked";i:1;s:13:"folderChecked";i:1;s:5:"buyed";i:0;s:8:"category";i:1;s:8:"children";a:3:{i:0;a:5:{s:4:"name";s:14:"p1.2.1.2.kurs1";s:2:"id";i:6207;s:8:"category";i:0;s:7:"checked";i:1;s:13:"folderChecked";i:0;}i:1;a:5:{s:4:"name";s:14:"p1.2.1.2.kurs2";s:2:"id";i:6208;s:8:"category";i:0;s:7:"checked";i:1;s:13:"folderChecked";i:0;}i:2;a:5:{s:4:"name";s:14:"p1.2.1.2.kurs3";s:2:"id";i:6670;s:8:"category";i:0;s:7:"checked";i:1;s:13:"folderChecked";i:0;}}}}}i:1;a:8:{s:2:"id";i:527;s:4:"name";s:6:"p1.2.2";s:15:"parent_category";i:471;s:7:"checked";i:1;s:13:"folderChecked";i:1;s:5:"buyed";i:0;s:8:"category";i:1;s:8:"children";a:3:{i:0;a:5:{s:4:"name";s:12:"p1.2.2.kurs1";s:2:"id";i:4926;s:8:"category";i:0;s:7:"checked";i:1;s:13:"folderChecked";i:0;}i:1;a:5:{s:4:"name";s:12:"p1.2.2.kurs2";s:2:"id";i:6469;s:8:"category";i:0;s:7:"checked";i:1;s:13:"folderChecked";i:0;}i:2;a:5:{s:4:"name";s:12:"p1.2.2.kurs3";s:2:"id";i:6491;s:8:"category";i:0;s:7:"checked";i:1;s:13:"folderChecked";i:0;}}}}}i:2;a:8:{s:2:"id";i:602;s:4:"name";s:4:"p1.3";s:15:"parent_category";i:467;s:7:"checked";i:1;s:13:"folderChecked";i:1;s:5:"buyed";i:0;s:8:"category";i:1;s:8:"children";a:3:{i:0;a:8:{s:2:"id";i:604;s:4:"name";s:6:"p1.3.1";s:15:"parent_category";i:602;s:7:"checked";i:1;s:13:"folderChecked";i:1;s:5:"buyed";i:0;s:8:"category";i:1;s:8:"children";a:3:{i:0;a:8:{s:2:"id";i:687;s:4:"name";s:8:"p1.3.1.1";s:15:"parent_category";i:604;s:7:"checked";i:1;s:13:"folderChecked";i:1;s:5:"buyed";i:0;s:8:"category";i:1;s:8:"children";a:3:{i:0;a:5:{s:4:"name";s:14:"p1.3.1.1.kurs1";s:2:"id";i:5664;s:8:"category";i:0;s:7:"checked";i:1;s:13:"folderChecked";i:0;}i:1;a:5:{s:4:"name";s:14:"p1.3.1.1.kurs2";s:2:"id";i:6255;s:8:"category";i:0;s:7:"checked";i:1;s:13:"folderChecked";i:0;}i:2;a:5:{s:4:"name";s:14:"p1.3.1.1.kurs3";s:2:"id";i:6675;s:8:"category";i:0;s:7:"checked";i:1;s:13:"folderChecked";i:0;}}}i:1;a:8:{s:2:"id";i:688;s:4:"name";s:8:"p1.3.1.2";s:15:"parent_category";i:604;s:7:"checked";i:1;s:13:"folderChecked";i:1;s:5:"buyed";i:0;s:8:"category";i:1;s:8:"children";a:17:{i:0;a:5:{s:4:"name";s:14:"p1.3.1.2.kurs1";s:2:"id";i:4981;s:8:"category";i:0;s:7:"checked";i:1;s:13:"folderChecked";i:0;}i:1;a:5:{s:4:"name";s:14:"p1.3.1.2.kurs2";s:2:"id";i:4984;s:8:"category";i:0;s:7:"checked";i:1;s:13:"folderChecked";i:0;}i:2;a:5:{s:4:"name";s:14:"p1.3.1.2.kurs3";s:2:"id";i:5007;s:8:"category";i:0;s:7:"checked";i:1;s:13:"folderChecked";i:0;}i:3;a:5:{s:4:"name";s:14:"p1.3.1.2.kurs4";s:2:"id";i:5010;s:8:"category";i:0;s:7:"checked";i:1;s:13:"folderChecked";i:0;}i:4;a:5:{s:4:"name";s:14:"p1.3.1.2.kurs5";s:2:"id";i:5012;s:8:"category";i:0;s:7:"checked";i:1;s:13:"folderChecked";i:0;}i:5;a:5:{s:4:"name";s:14:"p1.3.1.2.kurs6";s:2:"id";i:5668;s:8:"category";i:0;s:7:"checked";i:1;s:13:"folderChecked";i:0;}i:6;a:5:{s:4:"name";s:14:"p1.3.1.2.kurs7";s:2:"id";i:5727;s:8:"category";i:0;s:7:"checked";i:1;s:13:"folderChecked";i:0;}i:7;a:5:{s:4:"name";s:14:"p1.3.1.2.kurs8";s:2:"id";i:5728;s:8:"category";i:0;s:7:"checked";i:1;s:13:"folderChecked";i:0;}i:8;a:5:{s:4:"name";s:14:"p1.3.1.2.kurs9";s:2:"id";i:5766;s:8:"category";i:0;s:7:"checked";i:1;s:13:"folderChecked";i:0;}i:9;a:5:{s:4:"name";s:15:"p1.3.1.2.kurs10";s:2:"id";i:6089;s:8:"category";i:0;s:7:"checked";i:1;s:13:"folderChecked";i:0;}i:10;a:5:{s:4:"name";s:15:"p1.3.1.2.kurs11";s:2:"id";i:6145;s:8:"category";i:0;s:7:"checked";i:1;s:13:"folderChecked";i:0;}i:11;a:5:{s:4:"name";s:15:"p1.3.1.2.kurs12";s:2:"id";i:6256;s:8:"category";i:0;s:7:"checked";i:1;s:13:"folderChecked";i:0;}i:12;a:5:{s:4:"name";s:15:"p1.3.1.2.kurs13";s:2:"id";i:6314;s:8:"category";i:0;s:7:"checked";i:1;s:13:"folderChecked";i:0;}i:13;a:5:{s:4:"name";s:15:"p1.3.1.2.kurs14";s:2:"id";i:6349;s:8:"category";i:0;s:7:"checked";i:1;s:13:"folderChecked";i:0;}i:14;a:5:{s:4:"name";s:15:"p1.3.1.2.kurs15";s:2:"id";i:6535;s:8:"category";i:0;s:7:"checked";i:1;s:13:"folderChecked";i:0;}i:15;a:5:{s:4:"name";s:15:"p1.3.1.2.kurs16";s:2:"id";i:6536;s:8:"category";i:0;s:7:"checked";i:1;s:13:"folderChecked";i:0;}i:16;a:5:{s:4:"name";s:15:"p1.3.1.2.kurs17";s:2:"id";i:6676;s:8:"category";i:0;s:7:"checked";i:1;s:13:"folderChecked";i:0;}}}i:2;a:8:{s:2:"id";i:689;s:4:"name";s:8:"p1.3.1.3";s:15:"parent_category";i:604;s:7:"checked";i:1;s:13:"folderChecked";i:1;s:5:"buyed";i:0;s:8:"category";i:1;s:8:"children";a:3:{i:0;a:5:{s:4:"name";s:14:"p1.3.1.3.kurs1";s:2:"id";i:4986;s:8:"category";i:0;s:7:"checked";i:1;s:13:"folderChecked";i:0;}i:1;a:5:{s:4:"name";s:14:"p1.3.1.3.kurs2";s:2:"id";i:6350;s:8:"category";i:0;s:7:"checked";i:1;s:13:"folderChecked";i:0;}i:2;a:5:{s:4:"name";s:14:"p1.3.1.3.kurs3";s:2:"id";i:6677;s:8:"category";i:0;s:7:"checked";i:1;s:13:"folderChecked";i:0;}}}}}i:1;a:8:{s:2:"id";i:605;s:4:"name";s:6:"p1.3.2";s:15:"parent_category";i:602;s:7:"checked";i:1;s:13:"folderChecked";i:1;s:5:"buyed";i:0;s:8:"category";i:1;s:8:"children";a:16:{i:0;a:5:{s:4:"name";s:12:"p1.3.2.kurs1";s:2:"id";i:5614;s:8:"category";i:0;s:7:"checked";i:1;s:13:"folderChecked";i:0;}i:1;a:5:{s:4:"name";s:12:"p1.3.2.kurs2";s:2:"id";i:5617;s:8:"category";i:0;s:7:"checked";i:1;s:13:"folderChecked";i:0;}i:2;a:5:{s:4:"name";s:12:"p1.3.2.kurs3";s:2:"id";i:5760;s:8:"category";i:0;s:7:"checked";i:1;s:13:"folderChecked";i:0;}i:3;a:5:{s:4:"name";s:12:"p1.3.2.kurs4";s:2:"id";i:5835;s:8:"category";i:0;s:7:"checked";i:1;s:13:"folderChecked";i:0;}i:4;a:5:{s:4:"name";s:12:"p1.3.2.kurs5";s:2:"id";i:5867;s:8:"category";i:0;s:7:"checked";i:1;s:13:"folderChecked";i:0;}i:5;a:5:{s:4:"name";s:12:"p1.3.2.kurs6";s:2:"id";i:6068;s:8:"category";i:0;s:7:"checked";i:1;s:13:"folderChecked";i:0;}i:6;a:5:{s:4:"name";s:12:"p1.3.2.kurs7";s:2:"id";i:6069;s:8:"category";i:0;s:7:"checked";i:1;s:13:"folderChecked";i:0;}i:7;a:5:{s:4:"name";s:12:"p1.3.2.kurs8";s:2:"id";i:6241;s:8:"category";i:0;s:7:"checked";i:1;s:13:"folderChecked";i:0;}i:8;a:5:{s:4:"name";s:12:"p1.3.2.kurs9";s:2:"id";i:6242;s:8:"category";i:0;s:7:"checked";i:1;s:13:"folderChecked";i:0;}i:9;a:5:{s:4:"name";s:13:"p1.3.2.kurs10";s:2:"id";i:6257;s:8:"category";i:0;s:7:"checked";i:1;s:13:"folderChecked";i:0;}i:10;a:5:{s:4:"name";s:13:"p1.3.2.kurs11";s:2:"id";i:6299;s:8:"category";i:0;s:7:"checked";i:1;s:13:"folderChecked";i:0;}i:11;a:5:{s:4:"name";s:13:"p1.3.2.kurs12";s:2:"id";i:6474;s:8:"category";i:0;s:7:"checked";i:1;s:13:"folderChecked";i:0;}i:12;a:5:{s:4:"name";s:13:"p1.3.2.kurs13";s:2:"id";i:6475;s:8:"category";i:0;s:7:"checked";i:1;s:13:"folderChecked";i:0;}i:13;a:5:{s:4:"name";s:13:"p1.3.2.kurs14";s:2:"id";i:6493;s:8:"category";i:0;s:7:"checked";i:1;s:13:"folderChecked";i:0;}i:14;a:5:{s:4:"name";s:13:"p1.3.2.kurs15";s:2:"id";i:6494;s:8:"category";i:0;s:7:"checked";i:1;s:13:"folderChecked";i:0;}i:15;a:5:{s:4:"name";s:13:"p1.3.2.kurs16";s:2:"id";i:6728;s:8:"category";i:0;s:7:"checked";i:1;s:13:"folderChecked";i:0;}}}i:2;a:8:{s:2:"id";i:606;s:4:"name";s:6:"p1.3.3";s:15:"parent_category";i:602;s:7:"checked";i:1;s:13:"folderChecked";i:1;s:5:"buyed";i:0;s:8:"category";i:1;s:8:"children";a:3:{i:0;a:5:{s:4:"name";s:12:"p1.3.3.kurs1";s:2:"id";i:5680;s:8:"category";i:0;s:7:"checked";i:1;s:13:"folderChecked";i:0;}i:1;a:5:{s:4:"name";s:12:"p1.3.3.kurs2";s:2:"id";i:5732;s:8:"category";i:0;s:7:"checked";i:1;s:13:"folderChecked";i:0;}i:2;a:5:{s:4:"name";s:12:"p1.3.3.kurs3";s:2:"id";i:6301;s:8:"category";i:0;s:7:"checked";i:1;s:13:"folderChecked";i:0;}}}}}}}}';

	$emptyArray = 'a:1:{i:0;a:8:{s:2:"id";i:467;s:4:"name";s:2:"p1";s:15:"parent_category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;s:5:"buyed";i:0;s:8:"category";i:1;s:8:"children";a:3:{i:0;a:8:{s:2:"id";i:407;s:4:"name";s:4:"p1.1";s:15:"parent_category";i:467;s:7:"checked";i:0;s:13:"folderChecked";i:0;s:5:"buyed";i:0;s:8:"category";i:1;s:8:"children";a:3:{i:0;a:8:{s:2:"id";i:408;s:4:"name";s:6:"p1.1.1";s:15:"parent_category";i:407;s:7:"checked";i:0;s:13:"folderChecked";i:0;s:5:"buyed";i:0;s:8:"category";i:1;s:8:"children";a:3:{i:0;a:5:{s:4:"name";s:12:"p1.1.1.kurs1";s:2:"id";i:4242;s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;}i:1;a:5:{s:4:"name";s:12:"p1.1.1.kurs2";s:2:"id";i:4245;s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;}i:2;a:5:{s:4:"name";s:12:"p1.1.1.kurs3";s:2:"id";i:5846;s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;}}}i:1;a:8:{s:2:"id";i:415;s:4:"name";s:6:"p1.1.2";s:15:"parent_category";i:407;s:7:"checked";i:0;s:13:"folderChecked";i:0;s:5:"buyed";i:0;s:8:"category";i:1;s:8:"children";a:3:{i:0;a:5:{s:4:"name";s:12:"p1.1.2.kurs1";s:2:"id";i:6149;s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;}i:1;a:5:{s:4:"name";s:12:"p1.1.2.kurs2";s:2:"id";i:6276;s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;}i:2;a:5:{s:4:"name";s:12:"p1.1.2.kurs3";s:2:"id";i:6662;s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;}}}i:2;a:8:{s:2:"id";i:416;s:4:"name";s:6:"p1.1.3";s:15:"parent_category";i:407;s:7:"checked";i:0;s:13:"folderChecked";i:0;s:5:"buyed";i:0;s:8:"category";i:1;s:8:"children";a:3:{i:0;a:5:{s:4:"name";s:12:"p1.1.3.kurs1";s:2:"id";i:6075;s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;}i:1;a:5:{s:4:"name";s:12:"p1.1.3.kurs2";s:2:"id";i:6277;s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;}i:2;a:5:{s:4:"name";s:12:"p1.1.3.kurs3";s:2:"id";i:6663;s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;}}}}}i:1;a:8:{s:2:"id";i:471;s:4:"name";s:4:"p1.2";s:15:"parent_category";i:467;s:7:"checked";i:0;s:13:"folderChecked";i:0;s:5:"buyed";i:0;s:8:"category";i:1;s:8:"children";a:2:{i:0;a:8:{s:2:"id";i:473;s:4:"name";s:6:"p1.2.1";s:15:"parent_category";i:471;s:7:"checked";i:0;s:13:"folderChecked";i:0;s:5:"buyed";i:0;s:8:"category";i:1;s:8:"children";a:2:{i:0;a:8:{s:2:"id";i:533;s:4:"name";s:8:"p1.2.1.1";s:15:"parent_category";i:473;s:7:"checked";i:0;s:13:"folderChecked";i:0;s:5:"buyed";i:0;s:8:"category";i:1;s:8:"children";a:3:{i:0;a:5:{s:4:"name";s:14:"p1.2.1.1.kurs1";s:2:"id";i:5489;s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;}i:1;a:5:{s:4:"name";s:14:"p1.2.1.1.kurs2";s:2:"id";i:6082;s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;}i:2;a:5:{s:4:"name";s:14:"p1.2.1.1.kurs3";s:2:"id";i:6669;s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;}}}i:1;a:8:{s:2:"id";i:534;s:4:"name";s:8:"p1.2.1.2";s:15:"parent_category";i:473;s:7:"checked";i:0;s:13:"folderChecked";i:0;s:5:"buyed";i:0;s:8:"category";i:1;s:8:"children";a:3:{i:0;a:5:{s:4:"name";s:14:"p1.2.1.2.kurs1";s:2:"id";i:6207;s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;}i:1;a:5:{s:4:"name";s:14:"p1.2.1.2.kurs2";s:2:"id";i:6208;s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;}i:2;a:5:{s:4:"name";s:14:"p1.2.1.2.kurs3";s:2:"id";i:6670;s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;}}}}}i:1;a:8:{s:2:"id";i:527;s:4:"name";s:6:"p1.2.2";s:15:"parent_category";i:471;s:7:"checked";i:0;s:13:"folderChecked";i:0;s:5:"buyed";i:0;s:8:"category";i:1;s:8:"children";a:3:{i:0;a:5:{s:4:"name";s:12:"p1.2.2.kurs1";s:2:"id";i:4926;s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;}i:1;a:5:{s:4:"name";s:12:"p1.2.2.kurs2";s:2:"id";i:6469;s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;}i:2;a:5:{s:4:"name";s:12:"p1.2.2.kurs3";s:2:"id";i:6491;s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;}}}}}i:2;a:8:{s:2:"id";i:602;s:4:"name";s:4:"p1.3";s:15:"parent_category";i:467;s:7:"checked";i:0;s:13:"folderChecked";i:0;s:5:"buyed";i:0;s:8:"category";i:1;s:8:"children";a:3:{i:0;a:8:{s:2:"id";i:604;s:4:"name";s:6:"p1.3.1";s:15:"parent_category";i:602;s:7:"checked";i:0;s:13:"folderChecked";i:0;s:5:"buyed";i:0;s:8:"category";i:1;s:8:"children";a:3:{i:0;a:8:{s:2:"id";i:687;s:4:"name";s:8:"p1.3.1.1";s:15:"parent_category";i:604;s:7:"checked";i:0;s:13:"folderChecked";i:0;s:5:"buyed";i:0;s:8:"category";i:1;s:8:"children";a:3:{i:0;a:5:{s:4:"name";s:14:"p1.3.1.1.kurs1";s:2:"id";i:5664;s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;}i:1;a:5:{s:4:"name";s:14:"p1.3.1.1.kurs2";s:2:"id";i:6255;s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;}i:2;a:5:{s:4:"name";s:14:"p1.3.1.1.kurs3";s:2:"id";i:6675;s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;}}}i:1;a:8:{s:2:"id";i:688;s:4:"name";s:8:"p1.3.1.2";s:15:"parent_category";i:604;s:7:"checked";i:0;s:13:"folderChecked";i:0;s:5:"buyed";i:0;s:8:"category";i:1;s:8:"children";a:17:{i:0;a:5:{s:4:"name";s:14:"p1.3.1.2.kurs1";s:2:"id";i:4981;s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;}i:1;a:5:{s:4:"name";s:14:"p1.3.1.2.kurs2";s:2:"id";i:4984;s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;}i:2;a:5:{s:4:"name";s:14:"p1.3.1.2.kurs3";s:2:"id";i:5007;s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;}i:3;a:5:{s:4:"name";s:14:"p1.3.1.2.kurs4";s:2:"id";i:5010;s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;}i:4;a:5:{s:4:"name";s:14:"p1.3.1.2.kurs5";s:2:"id";i:5012;s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;}i:5;a:5:{s:4:"name";s:14:"p1.3.1.2.kurs6";s:2:"id";i:5668;s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;}i:6;a:5:{s:4:"name";s:14:"p1.3.1.2.kurs7";s:2:"id";i:5727;s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;}i:7;a:5:{s:4:"name";s:14:"p1.3.1.2.kurs8";s:2:"id";i:5728;s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;}i:8;a:5:{s:4:"name";s:14:"p1.3.1.2.kurs9";s:2:"id";i:5766;s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;}i:9;a:5:{s:4:"name";s:15:"p1.3.1.2.kurs10";s:2:"id";i:6089;s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;}i:10;a:5:{s:4:"name";s:15:"p1.3.1.2.kurs11";s:2:"id";i:6145;s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;}i:11;a:5:{s:4:"name";s:15:"p1.3.1.2.kurs12";s:2:"id";i:6256;s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;}i:12;a:5:{s:4:"name";s:15:"p1.3.1.2.kurs13";s:2:"id";i:6314;s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;}i:13;a:5:{s:4:"name";s:15:"p1.3.1.2.kurs14";s:2:"id";i:6349;s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;}i:14;a:5:{s:4:"name";s:15:"p1.3.1.2.kurs15";s:2:"id";i:6535;s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;}i:15;a:5:{s:4:"name";s:15:"p1.3.1.2.kurs16";s:2:"id";i:6536;s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;}i:16;a:5:{s:4:"name";s:15:"p1.3.1.2.kurs17";s:2:"id";i:6676;s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;}}}i:2;a:8:{s:2:"id";i:689;s:4:"name";s:8:"p1.3.1.3";s:15:"parent_category";i:604;s:7:"checked";i:0;s:13:"folderChecked";i:0;s:5:"buyed";i:0;s:8:"category";i:1;s:8:"children";a:3:{i:0;a:5:{s:4:"name";s:14:"p1.3.1.3.kurs1";s:2:"id";i:4986;s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;}i:1;a:5:{s:4:"name";s:14:"p1.3.1.3.kurs2";s:2:"id";i:6350;s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;}i:2;a:5:{s:4:"name";s:14:"p1.3.1.3.kurs3";s:2:"id";i:6677;s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;}}}}}i:1;a:8:{s:2:"id";i:605;s:4:"name";s:6:"p1.3.2";s:15:"parent_category";i:602;s:7:"checked";i:0;s:13:"folderChecked";i:0;s:5:"buyed";i:0;s:8:"category";i:1;s:8:"children";a:16:{i:0;a:5:{s:4:"name";s:12:"p1.3.2.kurs1";s:2:"id";i:5614;s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;}i:1;a:5:{s:4:"name";s:12:"p1.3.2.kurs2";s:2:"id";i:5617;s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;}i:2;a:5:{s:4:"name";s:12:"p1.3.2.kurs3";s:2:"id";i:5760;s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;}i:3;a:5:{s:4:"name";s:12:"p1.3.2.kurs4";s:2:"id";i:5835;s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;}i:4;a:5:{s:4:"name";s:12:"p1.3.2.kurs5";s:2:"id";i:5867;s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;}i:5;a:5:{s:4:"name";s:12:"p1.3.2.kurs6";s:2:"id";i:6068;s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;}i:6;a:5:{s:4:"name";s:12:"p1.3.2.kurs7";s:2:"id";i:6069;s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;}i:7;a:5:{s:4:"name";s:12:"p1.3.2.kurs8";s:2:"id";i:6241;s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;}i:8;a:5:{s:4:"name";s:12:"p1.3.2.kurs9";s:2:"id";i:6242;s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;}i:9;a:5:{s:4:"name";s:13:"p1.3.2.kurs10";s:2:"id";i:6257;s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;}i:10;a:5:{s:4:"name";s:13:"p1.3.2.kurs11";s:2:"id";i:6299;s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;}i:11;a:5:{s:4:"name";s:13:"p1.3.2.kurs12";s:2:"id";i:6474;s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;}i:12;a:5:{s:4:"name";s:13:"p1.3.2.kurs13";s:2:"id";i:6475;s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;}i:13;a:5:{s:4:"name";s:13:"p1.3.2.kurs14";s:2:"id";i:6493;s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;}i:14;a:5:{s:4:"name";s:13:"p1.3.2.kurs15";s:2:"id";i:6494;s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;}i:15;a:5:{s:4:"name";s:13:"p1.3.2.kurs16";s:2:"id";i:6728;s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;}}}i:2;a:8:{s:2:"id";i:606;s:4:"name";s:6:"p1.3.3";s:15:"parent_category";i:602;s:7:"checked";i:0;s:13:"folderChecked";i:0;s:5:"buyed";i:0;s:8:"category";i:1;s:8:"children";a:3:{i:0;a:5:{s:4:"name";s:12:"p1.3.3.kurs1";s:2:"id";i:5680;s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;}i:1;a:5:{s:4:"name";s:12:"p1.3.3.kurs2";s:2:"id";i:5732;s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;}i:2;a:5:{s:4:"name";s:12:"p1.3.3.kurs3";s:2:"id";i:6301;s:8:"category";i:0;s:7:"checked";i:0;s:13:"folderChecked";i:0;}}}}}}}}';


	
	$array = unserialize($serialized);
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