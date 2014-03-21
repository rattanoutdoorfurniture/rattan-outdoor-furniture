<?php

$installer = $this;
/* @var $installer Mage_Core_Model_Resource_Setup */

$installer->startSetup();


try {
    $post = Mage::getModel('blog/post')->loadByIdentifier('Hello');

    $post->setData('identifier', 'hello');
    $post->setData('title', 'Hello world');
    $post->setData('status', '1');

    $post->setData('created_time', Mage::getModel('core/date')->gmtDate());
    $post->setData('update_time', null);
    $post->setData('user', 'Hello world');
    $post->setData('update_user', 'Hello world');

    $post->setData('meta_keywords', 'Hello world');
    $post->setData('meta_description', 'Hello world');


    $post->setData('post_content', '<p>Hello world</p>');



    $cats = Mage::getModel('blog/cat')->getCollection();
    foreach ($cats as $cat) {
        if ($cat->getIdentifier() == 'news') {
            $post->setData('cats', array($cat->getId()));
            break;
        }
    }

    $post->save();
} catch (Exception $exc) {
    
}

$installer->endSetup();

