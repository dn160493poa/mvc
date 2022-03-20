<?php /* @var dto\ContainerOfCalls $container */ ?>

<table>
    <thead>
    <tr>
        <th>Customer ID</th>
        <th></th>
        <th></th>
        <th></th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($container->get() as $item): ?>
        <tr>
            <td><?= $item->getCustomerId() ?></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
