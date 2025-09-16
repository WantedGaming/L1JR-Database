<?php
// index.php
include 'includes/functions.php';
include 'includes/header.php';
include 'includes/hero.php';
?>

<main class="container">
    <div class="cards-grid">
        <?php
        $categories = getCategories();
        foreach ($categories as $category) {
            $imageName = strtolower($category) . '.png';
            
             // Determine the correct link path for each category
            if ($category === 'Weapons') {
                $link = 'categories/weapon/weapon_list.php';
            } else if ($category === 'Armor') {
                $link = 'categories/armor/armor_list.php';
            } else if ($category === 'Items') {
                $link = 'categories/items/item_list.php';
            } else if ($category === 'Monsters') {
                $link = 'categories/monsters/monster_list.php';
            } else if ($category === 'NPCs') {
                $link = 'categories/npcs/npc_list.php';
            } else if ($category === 'Dolls') {
                $link = 'categories/dolls/doll_list.php';
            } else if ($category === 'Maps') {
                $link = 'categories/maps/maps_list.php';
            } else if ($category === 'Skills') {
                $link = 'categories/skill/skill_list.php';
            } else if ($category === 'Polymorph') {
                $link = 'categories/polymorph/polymorph_list.php';
            } else if ($category === 'Crafting') {
                $link = 'categories/crafting/crafting_list.php';
            } else {
                // For other categories, use the default pattern
                $link = strtolower($category) . '.php';
            }
            
            echo '
            <div class="card">
                <a href="' . $link . '" class="card-link">
                    <img src="assets/img/placeholders/' . $imageName . '" alt="' . $category . '" class="card-image">
                    <h3 class="card-title">' . $category . '</h3>
                </a>
            </div>';
        }
        ?>
    </div>
</main>

<?php
include 'includes/footer.php';
?>