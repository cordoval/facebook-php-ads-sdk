<?php
/**
 * Copyright 2014 Facebook, Inc.
 *
 * You are hereby granted a non-exclusive, worldwide, royalty-free license to
 * use, copy, modify, and distribute this software in source code or binary
 * form for use in connection with the web services and APIs provided by
 * Facebook.
 *
 * As with any software that integrates with the Facebook platform, your use
 * of this software is subject to the Facebook Developer Principles and
 * Policies [http://developers.facebook.com/policy/]. This copyright notice
 * shall be included in all copies or substantial portions of the software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL
 * THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING
 * FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER
 * DEALINGS IN THE SOFTWARE.
 *
 */

namespace FacebookAds\Object;

use FacebookAds\Api;
use FacebookAds\Object\Fields\CustomAudienceFields;

class CustomAudience extends AbstractCrudObject {

  /**
   * @var string
   */
  const HASH_TYPE_MD5 = 'md5';

  /**
   * @var string
   */
  const HASH_TYPE_SHA256 = 'sha256';

  /**
   * @var string
   */
  const LAL_TYPE_SIMILARITY = 'similarity';

  /**
   * @var string
   */
  const LAL_TYPE_REACH = 'reach';

  /**
   * @var string[]
   **/
  protected static $fields = array(
    CustomAudienceFields::ID,
    CustomAudienceFields::ACCOUNT_ID,
    CustomAudienceFields::APPROXIMATE_COUNT,
    CustomAudienceFields::LOOKALIKE_AUDIENCE_IDS,
    CustomAudienceFields::NAME,
    CustomAudienceFields::PARENT_AUDIENCE_ID,
    CustomAudienceFields::PARENT_CATEGORY,
    CustomAudienceFields::RULE,
    CustomAudienceFields::RETENTION_DAYS,
    CustomAudienceFields::STATUS,
    CustomAudienceFields::SUBTYPE,
    CustomAudienceFields::TYPE,
    CustomAudienceFields::TYPE_NAME,
    CustomAudienceFields::TIME_UPDATED,
    CustomAudienceFields::DESCRIPTION,
    CustomAudienceFields::OPT_OUT_LINK,
    CustomAudienceFields::ORIGIN_AUDIENCE_ID,
    CustomAudienceFields::LOOKALIKE_SPEC,
  );

  /**
   * @return string
   */
  protected function getEndpoint() {
    return 'customaudiences';
  }

  /**
   * Add users to the AdCustomAudiences. There is no max on the total number of
   * users that can be added to an audience, but up to 10000 users can be added
   * at a given time.
   *
   * @param array $users Array of user info
   * @return boolean Returns true on success
   */
  public function addUsers($users) {
    return $this->getApi()->call(
      '/'.$this->assureId().'/users',
      Api::HTTP_METHOD_POST,
      array('users' => $users))->getResponse();
  }

  /**
   * Delete users from AdCustomAudiences
   *
   * @param array $users Array of user info
   * @return boolean Returns true on success
   */
  public function removeUsers($users) {
    return $this->getApi()->call(
      '/'.$this->assureId().'/users',
      Api::HTTP_METHOD_DELETE,
      array('users' => $users))->getResponse();
  }

  /**
   * Share this AdCustomAudiences to other accounts
   *
   * @param array $act_ids Array of account IDs
   * @return boolean Returns true on success
   */
  public function addSharedAccounts($act_ids) {
    return $this->getApi()->call(
      '/'.$this->assureId().'/adaccounts',
      Api::HTTP_METHOD_POST,
      array('adaccounts' => $act_ids))->getResponse();
  }

  /**
   * Remove accounts from the shared AdCustomAudiences
   *
   * @param  array $act_ids       Array of Account IDs to remove
   * @return boolean              Returns true on success
   */
  public function removeSharedAccounts($act_ids) {
    return $this->getApi()->call(
      '/'.$this->assureId().'/adaccounts',
      Api::HTTP_METHOD_DELETE,
      array('adaccounts' => $act_ids))->getResponse();
  }

  /**
   * Remove list of users decided to opt-out from all custom audiences
   *
   * @param array $users Array of user info
   * @return boolean Returns true on success
   */
  public function optOutUsers($users) {
    return $this->getApi()->call(
      '/'.$this->assureParentId().'/usersofanyaudience',
      Api::HTTP_METHOD_DELETE,
      array('users' => $users))->getResponse();
  }
}
