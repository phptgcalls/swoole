<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Account;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param Vector<PrivacyRule> rules Vector<Chat> chats Vector<User> users
 * @return account.PrivacyRules
 */

final class PrivacyRules extends Instance {
	public function request(array $rules,array $chats,array $users) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x50a04e45);
		$writer->tgwriteVector($rules,'PrivacyRule');
		$writer->tgwriteVector($chats,'Chat');
		$writer->tgwriteVector($users,'User');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['rules'] = $reader->tgreadVector('PrivacyRule');
		$result['chats'] = $reader->tgreadVector('Chat');
		$result['users'] = $reader->tgreadVector('User');
		return new self($result);
	}
}

?>