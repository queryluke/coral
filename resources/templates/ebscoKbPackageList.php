<?php
    if(empty($page)) {
        $page = 1;
    }
?>

<table id='resource_table' class='dataTable table-striped' style='width:840px'>
    <thead>
        <tr>
            <th><?php echo _("Name"); ?></th>
            <th><?php echo _("Title Count"); ?></th>
            <th><?php echo _("Content Type"); ?></th>
            <th><?php echo _("Current Status"); ?></th>
            <th><?php echo _("Current Holdings"); ?></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach($items as $item): ?>
        <?php $item->loadResource(); ?>
        <tr>
            <td>
                <?php echo $item->packageName; ?>
                <br>
                <small>(<?php echo $item->vendorName; ?>)</small>
            </td>
            <td>
                <?php echo $item->titleCount; ?>
                <a href="javascript:void(0);" class="setPackage"
                   data-vendor-id="<?php echo $item->vendorId; ?>"
                   data-package-id="<?php echo $item->packageId; ?>"
                   data-package-name="<?php echo $item->packageName; ?>"><?php echo '('._('view').')'; ?></a>
                <?php if($item->selectedCount != $item->titleCount): ?>
                    <br>
                    <small>(<?php echo $item->selectedCount.' '._('selected'); ?>)</small>
                <?php endif; ?>
            </td>
            <td>
                <?php echo $item->contentType; ?>
            </td>
            <td style="text-align: center;">
                <?php if($item->resource): ?>
                    <?php if($item->selectedCount): ?>
                        <a href="resource.php?resourceID=<?php echo $item->resource->primaryKey; ?>">
                            <i class="fa fa-check text-success" title="<?php echo _('imported in Coral'); ?>"></i>
                            <?php echo _('View in Coral'); ?>
                        </a>
                    <?php else: ?>
                        <i class="fa fa-ban text-danger" title="<?php echo _('Not selected in EBSCOhost'); ?>"></i>
                        <a href="ajax_forms.php?action=getEbscoKbRemoveConfirmation&height=700&width=730&modal=true&resourceID=<?php echo $item->resource->primaryKey; ?>&page=<?php echo $page ?>"
                            class="thickbox">
                            <?php echo _('Delete from Coral'); ?>
                        </a>
                    <?php endif; ?>
                <?php elseif ($item->selectedCount): ?>
                    <i class="fa fa-exclamation-triangle text-warning" title="<?php echo _('Selected but not Imported'); ?>"></i>
                    <a href="ajax_forms.php?action=getEbscoKbPackageImportForm&height=700&width=730&modal=true&vendorId=<?php echo $item->vendorId; ?>&packageId=<?php echo $item->packageId; ?>"
                       class="thickbox">
                        <?php echo _('Import Package'); ?>
                    </a>
                <?php endif; ?>
            </td>
            <td style="text-align: center;">
                <?php
                    unset($ebscoDropdownConfig);
                    $ebscoDropdownConfig = [
                        'vendorId' => $item->vendorId,
                        'packageId' => $item->packageId,
                        'selected' => $item->isSelected,
                        'resourceID' => $item->resource ? $item->resource->primaryKey : null,
                        'page' => $page,
                    ];
                    include 'ebscoKbPackageDropdown.php';
                ?>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
