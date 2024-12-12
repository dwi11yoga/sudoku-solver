<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en" class="dark">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Sudoku solver</title>

  <!-- Tailwind -->
  <script src="https://cdn.tailwindcss.com"></script>
  <!-- js -->
  <script src="js/script.js"></script>
  <!-- Feathericon -->
  <script src="https://unpkg.com/feather-icons"></script>
</head>

<body class="dark:bg-zinc-800">

  <div class="container w-1/2 p-12 mx-auto flex items-center justify-center h-screen">
    <div>
      <div
        class="shadow-sm border border-2 border-neutral-200 bg-white p-8 rounded-xl dark:bg-zinc-800 dark:border-zinc-700">
        <h1 class="font-semibold mb-3 dark:text-zinc-100">Sudoku Solver</h1>
        <?php if (isset($_SESSION['status']) && $_SESSION['status'] == 'failed') { ?>
          <div class="bg-red-400 my-3 rounded-lg py-3 px-5 dark:bg-red-500 dark:text-white">
            Sudoku can't be solved 😔🙏
          </div>
        <?php } ?>
        <form action="solver.php" method="post">
          <!-- Membuat grid Sudoku 9x9 -->
          <table class="text-center text-white">

            <?php for ($i = 0; $i < 9; $i++) { ?>

              <tr>
                <?php
                for ($j = 0; $j < 9; $j++) { ?>

                  <td>
                    <input type="text" min="1" max="9" id="<?php echo "cell-$i-$j" ?>" name="<?php echo "cell[$i][$j]" ?>"
                      value="<?php echo $_SESSION['grid'][$i][$j] ?? '' ?>"
                      class="border w-8 text-center text-black dark:bg-zinc-800 dark:text-zinc-100 dark:border-zinc-700">
                  </td>

                  <?php if ($j == 2 || $j == 5) {
                    echo "<td class='text-black dark:text-zinc-400'>|</td>";
                  }
                  ?>

                <?php } ?>
              </tr>

              <?php if ($i == 2 || $i == 5) { ?>

                <tr>

                  <?php for ($j = 0; $j < 11; $j++) { ?>

                    <?php
                    if ($j == 3 || $j == 7) {
                      echo "<td><div class='-mt-2.5 -mb-1.5 text-black dark:text-zinc-400'>-</div></td>";
                    } else {
                      echo "<td><div class='-mt-2.5 -mb-1.5 text-black dark:text-zinc-400'>―</div></td>";
                    } ?>

                  <?php } ?>
                </tr>

              <?php } ?>
            <?php } ?>
          </table>
          <div class="flex space-x-2">
            <button type="submit" class="mt-4 rounded-full bg-sky-400 px-5 py-2 hover:bg-sky-500">Solve</button>
            <div id="clear" onclick="clearSudoku()"
              class="mt-4 rounded-full bg-neutral-200 px-5 py-2 cursor-pointer hover:bg-neutral-300 dark:bg-zinc-500">
              Clear
            </div>
          </div>
        </form>
      </div>

      <div class="flex items-center justify-between mt-2">
        <div class="text-sm text-black dark:text-zinc-100">
          <!-- By
          <a href="https://github.com/dwi11yoga" target="_blank"
            class="hover:underline hover:decoration-amber-400 hover:decoration-2 hover:underline-offset-4">
            Dwi Yoga Yulian Nugroho
          </a> -->
        </div>
        <div>
          <input id="darkModeToggle" type="checkbox" onchange="darkModeToggle()" hidden>
          <label for="darkModeToggle"
            class="rounded-full py-2 px-4 flex justify-center items-center cursor-pointer hover:bg-neutral-100 dark:text-neutral-100 dark:hover:bg-neutral-700">

            <div id="sun" class="flex">
              <span>Light</span>
              <i data-feather='sun' class="w-5 ml-2"></i>
            </div>

            <div id="moon" class="flex cursor-pointer">
              <span>Dark</span>
              <i data-feather='moon' class="w-5 ml-2"></i>
            </div>

          </label>
        </div>
      </div>

    </div>
  </div>

  <?php session_destroy(); ?>



  <script>
    document.addEventListener('DOMContentLoaded', () => {
      initializeDarkMode();
      darkModeLabel(document.getElementById('sun'), document.getElementById('moon'));
    })

    feather.replace();
  </script>

</body>

</html>