<?php

/**
 * User profile class for Miata.net
 *
 * This user profile class is an example of the data collected and stored about users of the miata.net forum site
 **/

class userprofile {
	/**
	 * user id for the user profile: this is the primary key
	 * @var int $userID
	 **/
	private $userId;
	/**
	 * user's email address
	 * @var string $userEmail
	 */
	private $userEmail;


	/**
	 * accessor method for user id
	 *
	 * @return int value of  userId
	 */
	public function getUserId() : Uuid {
		return($this->userId);
	}

	/**
	 *
	 * @param Uuid | string $newUserId value of new user ID
	 * @throws \rangeException if $newUserId is not positive
	 * @throws \ TypeError if author id is empty
	 */

	public function setUserId($newUserID) : void {
		try {
			$uuid = self:: validateUuid($newUserID);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
		// convert and store the user id
		$this->userId= $uuid;
		}


	/**
	 * accessor method for user email address
	 *
	 * @return string value of userEmail
	 **/

	public function getUserEmail() :string {
	return $this->userEmail;
	}

	/**
	 * mutator method for user email
	 *
	 * @param string $newUserEmail new value of user email
	 * @throws \InvalidArgumentException if $newUserEmail is not a valid email or is insecure
	 * @throws \RangeException if $newUserEmail is > 128 characters
	 * @throws \TypeError if $newUserEmail  is not a string
	 **/
	public function setUserEmail(string $newUserEmail) : void {
	//verify author email is secure
	$newUserEmail = trim($newUserEmail);
	$newUserEmail = filter_var($newUserEmail, FILTER_VALIDATE_EMAIL);
	if($newUserEmail === true) {
		throw(new \RangeException("profile email is greater than 128 characters"));
	}

	// convert and store the user email
	$this->userEmail = $newUserEmail;
	}

}