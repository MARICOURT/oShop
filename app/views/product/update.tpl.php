<div class="container my-4">
    <a href="categories.html" class="btn btn-success float-right">Retour</a>
    <h2>Modifier un produit</h2>
    
    <form action="<?= $router->generate('product-updatepost') ?>" method="POST" class="mt-5">
        <input type="hidden" name="id" value="<?= $product->getId() ?>">
        <div class="form-group">
            <label for="name">Nom</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Nom du produit" value="<?= $product->getName() ?>">
        </div>
        <div class="form-group">
            <label for="description">Tags</label>
            <?php foreach ($tagList as $tag) : ?>
            <span class="badge badge-secondary"><?= $tag['tag_name'] ?></span>
            <?php endforeach; ?>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <input type="text" class="form-control" id="description" name="description" placeholder="description" aria-describedby="subtitleHelpBlock" value="<?= $product->getDescription() ?>">
            <small id="subtitleHelpBlock" class="form-text text-muted">
                La description du produit
            </small>
        </div>
        <div class="form-group">
            <label for="picture">Image</label>
            <input type="text" class="form-control" id="picture" name="picture" placeholder="image jpg, gif, svg, png" aria-describedby="pictureHelpBlock" value="<?= $product->getPicture() ?>">
            <small id="pictureHelpBlock" class="form-text text-muted">
                URL relative d'une image (jpg, gif, svg ou png) fournie sur <a href="https://benoclock.github.io/S06-images/" target="_blank">cette page</a>
            </small>
        </div>
        <div class="form-group">
            <label for="price">Prix</label>
            <input type="text" class="form-control" id="price" name="price" placeholder="Prix" aria-describedby="subtitleHelpBlock" value="<?= $product->getPrice() ?>">
            <small id="subtitleHelpBlock" class="form-text text-muted">
                Prix du produit
            </small>
        </div>
        <div class="form-group">
            <label for="status">Le status du produit</label>
            <input type="text" class="form-control" id="status" name="status" placeholder="Status du produit" aria-describedby="subtitleHelpBlock" value="<?= $product->getStatus() ?>">
            <small id="subtitleHelpBlock" class="form-text text-muted">
                le status du produit (1 dispo | 2 pas dispo)
            </small>
        </div>
        <div class="form-group">
            <label for="brand">Marque</label>
            <select id="brand" name="brandId">
                <option value="0"></option>
                <?php 
                    foreach ($brandList as $brand) : 
                        // si l'id de la marque courante correspond à l'id de la marque enregistrée pour le produit qu'on modifie, on ajoute 'selected' à l'élément <option>
                        $selected = $brand->getId() == $product->getBrandId() ? 'selected' : '';
                ?>
                <option <?= $selected ?> value="<?= $brand->getId() ?>"><?= $brand->getName() ?></option>
                <?php endforeach; ?>
            </select>
            <small id="pictureHelpBlock" class="form-text text-muted">
                Choix de la marque du produit
            </small>
        </div>
        <div class="form-group">
            <label for="category">Catégorie</label>
            <select id="category" name="categoryId">
                <option value="0"></option>
                <?php 
                    foreach ($categoryList as $category) : 
                        // si l'id de la marque courante correspond à l'id de la marque enregistrée pour le produit qu'on modifie, on ajoute 'selected' à l'élément <option>
                        $selected = $category->getId() == $product->getCategoryId() ? 'selected' : '';
                ?>
                <option <?= $selected ?> value="<?= $category->getId() ?>"><?= $category->getName() ?></option>
                <?php endforeach; ?>
            </select>
            <small id="pictureHelpBlock" class="form-text text-muted">
                Choix de la catégorie à laquelle lier ce produit
            </small>
        </div>
        <div class="form-group">
            <label for="type">Type de produit</label>
            <select id="type"name="typeId">
                <option selected value="0"></option>
                <?php 
                foreach ($typeList as $type) : 
                    // si l'id de la marque courante correspond à l'id de la marque enregistrée pour le produit qu'on modifie, on ajoute 'selected' à l'élément <option>
                    $selected = $type->getId() == $product->getTypeId() ? 'selected' : '';
                ?>
                <option <?= $selected ?> value="<?= $type->getId() ?>"><?= $type->getName() ?></option>
                <?php endforeach; ?>
            </select>
            <small id="pictureHelpBlock" class="form-text text-muted">
                Choix du type de ce produit
            </small>
        </div>
        <button type="submit" class="btn btn-primary btn-block mt-5">Valider</button>
    </form>
</div>