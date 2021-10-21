<?php
  require_once('data.php');
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Pokedex1 BY SUSHANTA</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.16/tailwind.min.css" integrity="sha512-5D0ofs3AsWoKsspH9kCWlY7qGxnHvdN/Yz2rTNwD9L271Mno85s+5ERo03qk9SUNtdgOZ4A9t8kRDexkvnWByA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/custom.css">
  </head>
  <body class="bg-gray-50">

    <div class="max-w-screen-lg mx-auto">

    <?php
      if(!$is_result) {
    ?>
      <div class="text-center text-red-700 text-5xl font-light">

        No Result

        <a href="">Button</a>

      </div>
    <?php
  } else {
    ?>
      <div class="max-w-screen-lg mx-auto my-12 border-4 border-double border-red-500 shadow-xl bg_yellow">
        <div class="grid grid-cols-5 gap-4">
          <div class="col-span-2 bg_blue">

              <h1 id="name" class="text-center text-white text-2xl font-light my-6 uppercase pokemon_font"><?php echo $data->name; ?></h1>
              <h3 id="name" class="text-center text-white text-gl font-light my-6 uppercase">ID: <?php echo $data->id; ?></h1>

              <img id="image" class="mx-auto my-6 w-48 bg-white border-4 border-double border_navy_blue" src="<?php echo $data->sprites->front_default; ?>" alt="">

              <div class="mx-auto text-center px-4 py-4">
                <form action="/" method="POST">
                  <input id="search" class="block w-full h-12 bg-white border-blue-600 px-4 my-4 box-border" type="text" name="pokemon" autocomplete="off" placeholder="Search for the pokemon with name or id">
                  <button id="run_search" class="w-32 h-12 bg-red-500 hover:bg-red-600 border border-red-700 rounded-sm text-white" type="submit">Search</button>
                </form>
              </div>

          </div>
          <div class="col-span-3">
            <div class="w-full px-6 py-6">
              <h2 class="text-white text-lg font-light my-6 uppercase pokemon_font text_navy_blue">Moves</h2>
              <div id="moves">
                <?php
                  foreach ($data->moves as $key=>$move) {
                    if($key <4) {
                ?>
                  <li class="list-none capitalize px-4 py-2 bg-white text-gray-700 my-2"><?php echo $move->move->name; ?></li>
                <?php
                    }
                  }
                ?>

              </div>
              <h2 class="text-white text-lg font-light my-6 uppercase pokemon_font text_navy_blue">Evolution</h2>
              <div id="evolutions" class="text-center w-full px-6 py-6 text-left bg-gray-100">
                <a href="<?php echo get_url($evolutions->chain->species->name); ?>">
                  <li class="list-none inline-block w-40 h-40 mx-4 my-2">
                  <img class="w-full h-full mx-4 inline-block border <?php if($evolutions->chain->species->name == $data->name) { echo 'border-blue-400'; } else { echo 'border-gray-300'; } ?> shadow-md" src="<?php echo get_img_url($evolutions->chain->species->name); ?>" alt="">
                  <span class="block mt-2 mb-4"><?php echo $evolutions->chain->species->name; ?></span>
                  </li>
                </a>
                <?php
                  foreach ($evolutions->chain->evolves_to as $evolves_to) {
                ?>

                <a href="<?php echo get_url($evolves_to->species->name) ?>">
                  <li class="list-none inline-block w-40 h-40 mx-2 my-2">
                    <img class="w-full h-full mx-4 inline-block border <?php if($evolves_to->species->name == $data->name) { echo 'border-blue-400'; } else { echo 'border-gray-300'; } ?> shadow-md" src="<?php echo get_img_url($evolves_to->species->name); ?>" alt="">
                    <span class="block mt-2 mb-4"><?php echo $evolves_to->species->name; ?></span>
                  </li>
                </a>

                <?php
                  foreach ($evolves_to->evolves_to as $evolves_to_2) {
                ?>

                <a href="<?php echo get_url($evolves_to_2->species->name) ?>">
                  <li class="list-none inline-block w-40 h-40 mx-2 my-2">
                    <img class="w-full h-full mx-4 inline-block border <?php if($evolves_to_2->species->name == $data->name) { echo 'border-blue-400'; } else { echo 'border-gray-300'; } ?> shadow-md" src="<?php echo get_img_url($evolves_to->species->name); ?>" alt="">
                    <span class="block mt-2 mb-4"><?php echo $evolves_to_2->species->name; ?></span>
                  </li>
                </a>

                 <?php
                  }
                ?>

                 <?php
                  }
                ?>
              </div>
            </div>

          </div>
        </div>
      </div>

      <div id="prev-next" class="w-full my-8">
        <?php if($data->id > 0) $value = $data->id - 1; { ?>
          <form action="/" method="POST" class="<?php if($data->id == 0) { echo 'hidden'; } ?>">
              <input type="hidden" name="pokemon" value="<?php echo $value; ?>">
              <button type="submit" class="w-24 h-24 rounded-sm hover:shadow-xl border-4 border-double border-yellow-400 bg-yellow-200 hover:bg-yellow-300 float-left" title="Previous">
                <img class="w-full h-full" src="<?php echo get_img_url($value); ?>" alt="Previous">
            </button>
          </form>
        <?php } ?>
        <?php if($data->id < $data_count->count) $value = $data->id + 1; { ?>
          <form action="/" method="POST" class="<?php if($data->id == $data_count->count) { echo 'hidden'; } ?>">
              <input type="hidden" name="pokemon" value="<?php echo $value; ?>">
              <button type="submit" class="w-24 h-24 rounded-sm hover:shadow-xl border-4 border-double border-blue-400 bg-blue-200 hover:bg-blue-300 float-right" title="Next">
                <img class="w-full h-full" src="<?php echo get_img_url($value); ?>" alt="Next">
            </button>
          </form>
        <?php } ?>
      </div>
    </div>

    <?php
      }
    ?>

  </body>
</html>
