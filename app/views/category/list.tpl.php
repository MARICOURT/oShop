<div class="container my-4">
        <a href="<?= $router->generate('category-add'); ?>" class="btn btn-success float-right">Ajouter</a>
        <h2>Liste des catégories</h2>
        <table class="table table-hover mt-4">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nom</th>
                    <th scope="col">Sous-titre</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <?php
                    // $categoryList vient de $viewVars (voir extract() dans la méthode show())
                    // pour chaque catégorie (objet Category), on affiche une ligne <tr> du tableau <table> en HTML
                    foreach($categoryList as $category) : 
                
                ?>
                <tr>
                    <th scope="row"><?= $category->getId() ?></th>
                    <td><?= $category->getName() ?></td>
                    <td><?= $category->getSubtitle() ?></td>
                    <td class="text-right">
                        <a href="<?= $router->generate('category-update', ['categoryId' => $category->getId()]) ?>" class="btn btn-sm btn-warning">
                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                        </a>
                        <!-- Example single danger button -->
                        <div class="btn-group">
                            <button type="button" class="btn btn-sm btn-danger dropdown-toggle"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-trash-o" aria-hidden="true"></i>
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="<?= $router->generate('category-delete', ['categoryId' => $category->getId()]); ?>?csrf-token=<?= $csrfToken ?>">Oui, je veux supprimer</a>
                                <a class="dropdown-item" href="#" data-toggle="dropdown">Oups !</a>
                            </div>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>