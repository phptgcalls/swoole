<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Premium;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param Vector<MyBoost> my_boosts Vector<Chat> chats Vector<User> users
 * @return premium.MyBoosts
 */

final class MyBoosts extends Instance {
	public function request(array $my_boosts,array $chats,array $users) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x9ae228e2);
		$writer->tgwriteVector($my_boosts,'MyBoost');
		$writer->tgwriteVector($chats,'Chat');
		$writer->tgwriteVector($users,'User');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['my_boosts'] = $reader->tgreadVector('MyBoost');
		$result['chats'] = $reader->tgreadVector('Chat');
		$result['users'] = $reader->tgreadVector('User');
		return new self($result);
	}
}

?>