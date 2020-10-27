<div class="container my-4">
    <a href="categories.html" class="btn btn-success float-right">Retour</a>
    <h2>Gestion de la page d'accueil</h2>

    <form id="home-categories-form" action="<?= $router->generate('main-home-categoriespost') ?>" method="POST" class="mt-5">
        <input type="hidden" name="csrf-token" value="<?= $csrfToken ?>">
        <div class="row">
            <?php 
                for ($i = 1; $i <= 5; $i++) :
            ?>
            <div class="col">
                <div class="form-group">
                    <label for="emplacement<?= $i ?>">Emplacement #<?= $i ?></label>
                    <select class="form-control" id="emplacement<?= $i ?>" name="emplacement[]">
                        <option value="">choisissez :</option>
                        <?php 
                            foreach ($categoryList as $category) :
                                 // gérer l'attribut selected
                                 $selected = '';
                                 if ($category->getHomeOrder() == $i){
                                     $selected = 'selected';
                                 }
                        ?>
                        <option value="<?= $category->getId() ?>" <?= $selected ?>>
                            <?= $category->getName() ?>
                        </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <?php endfor; ?>
        </div>
        <button type="submit" class="btn btn-primary btn-block mt-5">Valider</button>
    </form>

</div>