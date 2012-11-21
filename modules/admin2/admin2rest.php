<?php
class admin2rest extends admin2rest_parent
{
	protected $_sThisTemplate = "admin2rest.tpl";

	public function render()
	{
		parent::render();
		$soxId = $this->getEditObjectId();
		$user = oxNew( "oxuser" );
		$user->load( $soxId );
		$this->_aViewData['edit'] = $user;
		return $this->_sThisTemplate;
	}

	public function save()
	{
		parent::save();
		 
		$soxId = $this->getEditObjectId();
		 
		if ( !$this->_allowAdminEdit( $soxId ) )
			return false;
		 
		$aParams = oxConfig::getParameter( "editval" );
		 
		$oUser = oxNew( "oxuser" );
		$oUser->load( $soxId );
		$oUser->assign($aParams);
		$oUser->save();
		 
		// set oxid if inserted
		$this->setEditObjectId($oUser->getId());
	}
}
