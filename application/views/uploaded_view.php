<?php /* @var dto\ContainerOfReport $container */ ?>

<table>
    <thead>
    <tr>
        <th>Customer ID</th>
        <th>Calls to same continent</th>
        <th>Duration continent</th>
        <th>Total calls</th>
        <th>Total duration</th>
    </tr>
    </thead>
    <tbody>

    <?php foreach ($container->getList() as $item): ?>
        <tr>
            <td style="text-align: center;"><?=$item->getCustomerId();?></td>
            <td style="text-align: center;"><?=$item->getCallToSameContinent();?></td>
            <td style="text-align: center;"><?=$item->getDurationToSameContinent();?></td>
            <td style="text-align: center;"><?=$item->getTotalCalls();?></td>
            <td style="text-align: center;"><?=$item->getTotalDuration();?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
