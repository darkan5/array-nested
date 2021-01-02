<?php


    mycourses();

    function mycourses($request = 0, $requestTest = false)
	{

		//dd($request);
		//$action = "remove";
		$action = "add";
		//dd($action);
		if ($requestTest){
			$req = array();
			$req['inputValue'] = $requestTest ;
			
		}
		else {
		$checkedIds = ["407"];
		}

	//	$checkedIds = ["471"] ;


		//4242
	
	//    $checkedIds = explode(',', $req['inputValue']);
		/// all tree with course
		//dd($checkedIds);
		$all_categories_tree = getRecurringCategories(0);
		//dd($all_categories_tree);
		// all tree course  checked
		$categories_tree = array();
		// all tree course  path
		//$categories_tree_path = array();



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
		var_dump($all_categories_tree);
	//	}



		//	$basket = $all_categories_tree ;
		//	dd($basket);

		//	$this->my_walk_recursive($basket);

	}

    function getRecurringCategories($categoryID = 0, $state = "start")
	{
        
    $serialized = 'a:2:{i:0;a:7:{s:2:"id";i:467;s:4:"name";s:2:"p1";s:15:"parent_category";i:0;s:7:"checked";s:5:"false";s:13:"folderChecked";s:5:"false";s:5:"buyed";s:5:"false";s:8:"children";a:3:{i:0;a:7:{s:2:"id";i:407;s:4:"name";s:4:"p1.1";s:15:"parent_category";i:467;s:7:"checked";s:5:"false";s:13:"folderChecked";s:5:"false";s:5:"buyed";s:5:"false";s:8:"children";a:3:{i:0;a:6:{s:2:"id";i:408;s:4:"name";s:6:"p1.1.1";s:15:"parent_category";i:407;s:7:"checked";s:5:"false";s:13:"folderChecked";s:5:"false";s:5:"buyed";s:5:"false";}i:1;a:6:{s:2:"id";i:415;s:4:"name";s:6:"p1.1.2";s:15:"parent_category";i:407;s:7:"checked";s:5:"false";s:13:"folderChecked";s:5:"false";s:5:"buyed";s:5:"false";}i:2;a:6:{s:2:"id";i:416;s:4:"name";s:6:"p1.1.3";s:15:"parent_category";i:407;s:7:"checked";s:5:"false";s:13:"folderChecked";s:5:"false";s:5:"buyed";s:5:"false";}}}i:1;a:7:{s:2:"id";i:471;s:4:"name";s:4:"p1.2";s:15:"parent_category";i:467;s:7:"checked";s:5:"false";s:13:"folderChecked";s:5:"false";s:5:"buyed";s:5:"false";s:8:"children";a:2:{i:0;a:7:{s:2:"id";i:473;s:4:"name";s:6:"p1.2.1";s:15:"parent_category";i:471;s:7:"checked";s:5:"false";s:13:"folderChecked";s:5:"false";s:5:"buyed";s:5:"false";s:8:"children";a:2:{i:0;a:6:{s:2:"id";i:533;s:4:"name";s:8:"p1.2.1.1";s:15:"parent_category";i:473;s:7:"checked";s:5:"false";s:13:"folderChecked";s:5:"false";s:5:"buyed";s:5:"false";}i:1;a:6:{s:2:"id";i:534;s:4:"name";s:8:"p1.2.1.2";s:15:"parent_category";i:473;s:7:"checked";s:5:"false";s:13:"folderChecked";s:5:"false";s:5:"buyed";s:5:"false";}}}i:1;a:6:{s:2:"id";i:527;s:4:"name";s:6:"p1.2.2";s:15:"parent_category";i:471;s:7:"checked";s:5:"false";s:13:"folderChecked";s:5:"false";s:5:"buyed";s:5:"false";}}}i:2;a:7:{s:2:"id";i:602;s:4:"name";s:4:"p1.3";s:15:"parent_category";i:467;s:7:"checked";s:5:"false";s:13:"folderChecked";s:5:"false";s:5:"buyed";s:5:"false";s:8:"children";a:3:{i:0;a:7:{s:2:"id";i:604;s:4:"name";s:6:"p1.3.1";s:15:"parent_category";i:602;s:7:"checked";s:5:"false";s:13:"folderChecked";s:5:"false";s:5:"buyed";s:5:"false";s:8:"children";a:3:{i:0;a:6:{s:2:"id";i:687;s:4:"name";s:8:"p1.3.1.1";s:15:"parent_category";i:604;s:7:"checked";s:5:"false";s:13:"folderChecked";s:5:"false";s:5:"buyed";s:5:"false";}i:1;a:6:{s:2:"id";i:688;s:4:"name";s:8:"p1.3.1.2";s:15:"parent_category";i:604;s:7:"checked";s:5:"false";s:13:"folderChecked";s:5:"false";s:5:"buyed";s:5:"false";}i:2;a:6:{s:2:"id";i:689;s:4:"name";s:8:"p1.3.1.3";s:15:"parent_category";i:604;s:7:"checked";s:5:"false";s:13:"folderChecked";s:5:"false";s:5:"buyed";s:5:"false";}}}i:1;a:6:{s:2:"id";i:605;s:4:"name";s:6:"p1.3.2";s:15:"parent_category";i:602;s:7:"checked";s:5:"false";s:13:"folderChecked";s:5:"false";s:5:"buyed";s:5:"false";}i:2;a:6:{s:2:"id";i:606;s:4:"name";s:6:"p1.3.3";s:15:"parent_category";i:602;s:7:"checked";s:5:"false";s:13:"folderChecked";s:5:"false";s:5:"buyed";s:5:"false";}}}}}i:1;a:7:{s:2:"id";i:469;s:4:"name";s:2:"p2";s:15:"parent_category";i:0;s:7:"checked";s:5:"false";s:13:"folderChecked";s:5:"false";s:5:"buyed";s:5:"false";s:8:"children";a:3:{i:0;a:7:{s:2:"id";i:483;s:4:"name";s:4:"p2.1";s:15:"parent_category";i:469;s:7:"checked";s:5:"false";s:13:"folderChecked";s:5:"false";s:5:"buyed";s:5:"false";s:8:"children";a:2:{i:0;a:6:{s:2:"id";i:547;s:4:"name";s:6:"p2.1.1";s:15:"parent_category";i:483;s:7:"checked";s:5:"false";s:13:"folderChecked";s:5:"false";s:5:"buyed";s:5:"false";}i:1;a:6:{s:2:"id";i:548;s:4:"name";s:6:"p2.1.2";s:15:"parent_category";i:483;s:7:"checked";s:5:"false";s:13:"folderChecked";s:5:"false";s:5:"buyed";s:5:"false";}}}i:1;a:7:{s:2:"id";i:484;s:4:"name";s:4:"p2.2";s:15:"parent_category";i:469;s:7:"checked";s:5:"false";s:13:"folderChecked";s:5:"false";s:5:"buyed";s:5:"false";s:8:"children";a:2:{i:0;a:6:{s:2:"id";i:549;s:4:"name";s:6:"p2.2.1";s:15:"parent_category";i:484;s:7:"checked";s:5:"false";s:13:"folderChecked";s:5:"false";s:5:"buyed";s:5:"false";}i:1;a:6:{s:2:"id";i:550;s:4:"name";s:6:"p2.2.2";s:15:"parent_category";i:484;s:7:"checked";s:5:"false";s:13:"folderChecked";s:5:"false";s:5:"buyed";s:5:"false";}}}i:2;a:7:{s:2:"id";i:485;s:4:"name";s:4:"p2.3";s:15:"parent_category";i:469;s:7:"checked";s:5:"false";s:13:"folderChecked";s:5:"false";s:5:"buyed";s:5:"false";s:8:"children";a:2:{i:0;a:6:{s:2:"id";i:551;s:4:"name";s:6:"p2.3.1";s:15:"parent_category";i:485;s:7:"checked";s:5:"false";s:13:"folderChecked";s:5:"false";s:5:"buyed";s:5:"false";}i:1;a:6:{s:2:"id";i:552;s:4:"name";s:6:"p2.3.2";s:15:"parent_category";i:485;s:7:"checked";s:5:"false";s:13:"folderChecked";s:5:"false";s:5:"buyed";s:5:"false";}}}}}}';
    $array = unserialize($serialized);

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
					dd($path);
				}
			} else {
				// directory node -- recurse
				my_walk_recursive($v, $path . '/' . $k);
			}
		}
	}
