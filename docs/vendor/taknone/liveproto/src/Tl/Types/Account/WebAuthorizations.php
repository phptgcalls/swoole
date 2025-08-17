<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Account;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param Vector<WebAuthorization> authorizations Vector<User> users
 * @return account.WebAuthorizations
 */

final class WebAuthorizations extends Instance {
	public function request(array $authorizations,array $users) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xed56c9fc);
		$writer->tgwriteVector($authorizations,'WebAuthorization');
		$writer->tgwriteVector($users,'User');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['authorizations'] = $reader->tgreadVector('WebAuthorization');
		$result['users'] = $reader->tgreadVector('User');
		return new self($result);
	}
}

?>