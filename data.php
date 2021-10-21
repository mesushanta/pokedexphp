<?php

  $is_result = false;
  $count_url = 'https://pokeapi.co/api/v2/pokemon-species';
  $result_count = file_get_contents($count_url);
  $data_count = json_decode($result_count);

  if(!isset($_POST['pokemon']) || $_POST['pokemon'] == NULL || $_POST['pokemon'] == "") {
      $input = rand(1,$data_count->count);
  }  else {
    $input = $_POST['pokemon'];
  }

    $url = 'https://pokeapi.co/api/v2/pokemon/'.$input;
    $file_headers = @get_headers($url);
    if(!$file_headers || $file_headers[0] == 'HTTP/1.1 404 Not Found') {
        $is_result = false;
    }
    else {
      $is_result = true;
      $result = file_get_contents($url);
      $data = json_decode($result);
      $evolutions = get_evolution($data->id);
    }


  function get_evolution($id) {
    $url = 'https://pokeapi.co/api/v2/pokemon-species/'.$id;

    $result = file_get_contents($url);
    $data = json_decode($result);
    // var_dump($data);
    $evolution_chain_url = $data->evolution_chain->url;
    $result_chain = file_get_contents($evolution_chain_url);
    $chains = json_decode($result_chain);

    return $chains;
  }

  function get_img_url($id) {
    $url = 'https://pokeapi.co/api/v2/pokemon/'.$id;
    $file_headers = @get_headers($url);
    $result = file_get_contents($url);
    $data = json_decode($result);
    return $data->sprites->front_default;
  }

  function get_url($id) {
    $url = 'http://pokedex.test/?pokemon='.$id;
    return $url;
  }
?>
