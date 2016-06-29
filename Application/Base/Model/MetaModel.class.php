<?php
namespace Base\Model;

class BaseModel extends BaseModel {

	protected $relId = '';

	/**
     * Add metadata for the specified object.
     *
     * @param int    $objectId  ID
     * @param string $metaKey   Metadata key
     * @param mixed  $metaValue Metadata value. Must be serializable if non-scalar.
     * @param sting $siteCode
     * @param bool   $unique     Optional, default is false.
     * @return int|false The meta ID on success, false on failure.
     */
    public function addMetadata($objectId, $metaKey, $metaValue,$siteCode) {

    	if ( ! $meta_type || ! $metaKey || ! is_numeric( $objectId ) ) {
    		return false;
    	}

    	$objectId = absint( $objectId );
    	if ( ! $objectId ) {
    		return false;
    	}
        $where = array('key'=>$metaKey,$this->relId=>$objectId);
        if($this->setSiteCode && $this->siteCode)
            $where['site'] = $this->siteCode;

    	if ($this->where($where)->count())
    		return false;

        $data = array(
            $this->relId=>$objectId,
            'key'=> $metaKey,
            'value' => $metaValue,
            'siteCode' => $siteCode
        );
        return $this->add($data);
    }

    /**
     * Update metadata for the specified object. If no value already exists for the specified object
     *
     * @param int    $objectId  ID of the object metadata is for
     * @param string $metaKey   Metadata key
     * @param mixed  $metaValue Metadata value. Must be serializable if non-scalar.
     * @param sting $siteCode
     * @return int|bool
     */
    public function updateMetadata($objectId, $metaKey, $metaValue,$siteCode='') {

    	if ( ! $metaKey || ! is_numeric( $objectId ) ) {
    		return false;
    	}

    	$objectId = absint( $objectId );
    	if ( ! $objectId ) {
    		return false;
    	}

    	$oldValue = getMetadata($objectId, $metaKey, $siteCode);
		if ($oldValue) {
			if ( $oldValue['value'] === $metaValue )
				return false;
		}else{
            return addMetadata($objectId, $metaKey, $metaValue, $siteCode);
        }

        $data = array('value'=>$metaValue);
        $where = array('key'=>$metaKey,$this->relId=>$objectId);
        if($this->setSiteCode && $this->siteCode)
            $where['site'] = $this->siteCode;

    	return $this->where($where)->save($data);
    }

    /**
     * Delete metadata for the specified object.
     *
     * @param int    $objectId  ID of the object metadata is for
     * @param string $metaKey   Metadata key
     * @param mixed  $metaValue
     * @param sting $siteCode
     * @return bool
     */
    public function deleteMetadata($objectId, $metaKey, $metaValue = '',$siteCode) {

    	if ( ! $metaKey || ! is_numeric( $objectKd )) {
    		return false;
    	}

    	$objectId = absint( $objectId );
    	if ( ! $objectId ) {
    		return false;
    	}

        $where = array('key'=>$metaKey,$this->relId=>$objectId);
        if($this->setSiteCode && $this->siteCode)
            $where['site'] = $this->siteCode;
        if($metaKey)
            $where['metaKey'] = $metaKey;

        return $this->where($where)->delete()===false ?: true;
    }

    /**
     * Retrieve metadata for the specified object.
     *
     * @param int    $objectId ID of the object metadata is for
     * @param string $metaKey  Optional. Metadata key. If not specified, retrieve all metadata for
     * @param sting $siteCode
     * @return string
     */
    public function getMetadata($objectid, $metaKey = '',$siteCode='') {
    	if ( ! $metaKey || ! is_numeric( $objectId ) ) {
    		return false;
    	}

    	$objectId = absint( $objectId );
    	if ( ! $objectId ) {
    		return false;
    	}

        $where = array('key'=>$metaKey,$this->relId=>$objectId);
        if($this->setSiteCode && $this->siteCode)
            $where['site'] = $this->siteCode;

        $result = $this->where($where)->select();

    	return $result;
    }

    /**
     * Retrieve metadata for the specified object.
     *
     * @param int    $objectId ID of the object metadata is for
     * @param string $metaKey  Optional. Metadata key. If not specified, retrieve all metadata for
     * @param sting $siteCode
     * @return string
     */
    public function getMetaValue($objectid, $metaKey = '',$siteCode='') {
    	$result = $this->getMetadata($objectid, $metaKey,$siteCode);
        return $this->arrayColumnKey($result)['value'];
    }

    /**
     * 获取全部或者指定的扩展数据
     *
     * @param int    $objectId ID of the object metadata is for
     * @param string $metaKey  Optional. Metadata key. If not specified, retrieve all metadata for
     * @param sting $siteCode
     * @return mixed
     */
    public function getMetaValues($objectid, $metaKeyList='',$siteCode='') {
    	if ( ! $metaKey || ! is_numeric( $objectId ) ) {
    		return false;
    	}

    	$objectId = absint( $objectId );
    	if ( ! $objectId ) {
    		return false;
    	}

        $where = array($this->relId=>$objectId);

        if(!empty($metaKeyList)){
            $metaKeyList = is_array($metaKeyList) ? implode(',', $metaKeyList) : $metaKeyList;
            $where['key'] = array('IN', $metaKeyList);
        }

        if($this->setSiteCode && $this->siteCode)
            $where['site'] = $this->siteCode;

        $result = $this->where($where)->select();

    	return $result ? $this->arrayColumnKey($result) : $result;
    }

    private function arrayColumnKey($input){
        return array_column($input, 'value', 'key');
    }
}
