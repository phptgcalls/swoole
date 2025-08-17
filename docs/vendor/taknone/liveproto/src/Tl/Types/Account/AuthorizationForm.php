<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Account;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param Vector<SecureRequiredType> required_types Vector<SecureValue> values Vector<SecureValueError> errors Vector<User> users string privacy_policy_url
 * @return account.AuthorizationForm
 */

final class AuthorizationForm extends Instance {
	public function request(array $required_types,array $values,array $errors,array $users,? string $privacy_policy_url = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xad2e1cd8);
		$flags = 0;
		$flags |= is_null($privacy_policy_url) ? 0 : (1 << 0);
		$writer->writeInt($flags);
		$writer->tgwriteVector($required_types,'SecureRequiredType');
		$writer->tgwriteVector($values,'SecureValue');
		$writer->tgwriteVector($errors,'SecureValueError');
		$writer->tgwriteVector($users,'User');
		if(is_null($privacy_policy_url) === false):
			$writer->tgwriteBytes($privacy_policy_url);
		endif;
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		$result['required_types'] = $reader->tgreadVector('SecureRequiredType');
		$result['values'] = $reader->tgreadVector('SecureValue');
		$result['errors'] = $reader->tgreadVector('SecureValueError');
		$result['users'] = $reader->tgreadVector('User');
		if($flags & (1 << 0)):
			$result['privacy_policy_url'] = $reader->tgreadBytes();
		else:
			$result['privacy_policy_url'] = null;
		endif;
		return new self($result);
	}
}

?>