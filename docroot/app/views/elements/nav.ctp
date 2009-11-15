<div id="nav">
    <?php echo $html->image('logo.png', array('id' => 'logo')); ?>
    <?php echo $menu->generate($nodes[0]['children'], array('element' => 'menu_li', 'plugin' => 'baked_simple', 'maxDepth' => 1)); ?>
</div>
