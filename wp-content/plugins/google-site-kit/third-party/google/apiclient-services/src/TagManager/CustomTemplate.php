<?php

/*
 * Copyright 2014 Google Inc.
 *
 * Licensed under the Apache License, Version 2.0 (the "License"); you may not
 * use this file except in compliance with the License. You may obtain a copy of
 * the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS, WITHOUT
 * WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied. See the
 * License for the specific language governing permissions and limitations under
 * the License.
 */
namespace Google\Site_Kit_Dependencies\Google\Service\TagManager;

class CustomTemplate extends \Google\Site_Kit_Dependencies\Google\Model
{
    public $accountId;
    public $containerId;
    public $fingerprint;
    protected $galleryReferenceType = \Google\Site_Kit_Dependencies\Google\Service\TagManager\GalleryReference::class;
    protected $galleryReferenceDataType = '';
    public $name;
    public $path;
    public $tagManagerUrl;
    public $templateData;
    public $templateId;
    public $workspaceId;
    public function setAccountId($accountId)
    {
        $this->accountId = $accountId;
    }
    public function getAccountId()
    {
        return $this->accountId;
    }
    public function setContainerId($containerId)
    {
        $this->containerId = $containerId;
    }
    public function getContainerId()
    {
        return $this->containerId;
    }
    public function setFingerprint($fingerprint)
    {
        $this->fingerprint = $fingerprint;
    }
    public function getFingerprint()
    {
        return $this->fingerprint;
    }
    /**
     * @param GalleryReference
     */
    public function setGalleryReference(\Google\Site_Kit_Dependencies\Google\Service\TagManager\GalleryReference $galleryReference)
    {
        $this->galleryReference = $galleryReference;
    }
    /**
     * @return GalleryReference
     */
    public function getGalleryReference()
    {
        return $this->galleryReference;
    }
    public function setName($name)
    {
        $this->name = $name;
    }
    public function getName()
    {
        return $this->name;
    }
    public function setPath($path)
    {
        $this->path = $path;
    }
    public function getPath()
    {
        return $this->path;
    }
    public function setTagManagerUrl($tagManagerUrl)
    {
        $this->tagManagerUrl = $tagManagerUrl;
    }
    public function getTagManagerUrl()
    {
        return $this->tagManagerUrl;
    }
    public function setTemplateData($templateData)
    {
        $this->templateData = $templateData;
    }
    public function getTemplateData()
    {
        return $this->templateData;
    }
    public function setTemplateId($templateId)
    {
        $this->templateId = $templateId;
    }
    public function getTemplateId()
    {
        return $this->templateId;
    }
    public function setWorkspaceId($workspaceId)
    {
        $this->workspaceId = $workspaceId;
    }
    public function getWorkspaceId()
    {
        return $this->workspaceId;
    }
}
// Adding a class alias for backwards compatibility with the previous class name.
\class_alias(\Google\Site_Kit_Dependencies\Google\Service\TagManager\CustomTemplate::class, 'Google\\Site_Kit_Dependencies\\Google_Service_TagManager_CustomTemplate');