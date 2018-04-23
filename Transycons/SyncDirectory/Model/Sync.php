<?php
class Transycons_SyncDirectory_Model_Sync
    extends Mage_Core_Model_Abstract
{
    const VISIBILITY_HIDDEN = '0';
    const VISIBILITY_DIRECTORY = '1';
    
    protected function _construct()
    {
        /**
         * This tells Magento where the related Resource Model can be found.
         * 
         * For a Resource Model, Magento will use the standard Model alias,
         * in this case 'transycons_syncdirectory' and look in
         * config.xml for a child node <resourceModel/>. This will be the
         * location Magento will look for a Model when 
         * Mage::getResourceModel() is called. In our case:
         * Transycons_SyncDirectory_Model_Resource
         */
        $this->_init('transycons_syncdirectory/sync');
    }
    
    /**
     * This method is used in grid and form for populating dropdown.
     */
    public function getAvailableVisibilies()
    {
        return array(
            self::VISIBILITY_HIDDEN 
                => Mage::helper('transycons_syncdirectory')
                       ->__('Hidden'),
            self::VISIBILITY_DIRECTORY
                => Mage::helper('transycons_syncdirectory')
                       ->__('Visible in Directory'),
        );
    }
    
    protected function _beforeSave()
    {
        parent::_beforeSave();
        
        /**
         * Perform some actions just before a Brand is saved.
         */
        $this->_updateTimestamps();
        $this->_prepareUrlKey();
        
        return $this;
    }
    
    protected function _updateTimestamps()
    {
        $timestamp = now();
        
        /**
         * Set the last updated timestamp.
         */
        $this->setUpdatedAt($timestamp);
        
        /**
         * If we have a brand new object, set the created timestamp.
         */
        if ($this->isObjectNew()) {
            $this->setCreatedAt($timestamp);
        }
        
        return $this;
    }
    
    protected function _prepareUrlKey()
    {
        /**
         * In this method you might consider ensuring
         * the URL Key entered is unique and contains
         * only alphanumeric characters.
         */
        
        return $this;
    }
}