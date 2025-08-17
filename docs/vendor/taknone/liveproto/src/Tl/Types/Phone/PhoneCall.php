<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Phone;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param phonecall phone_call Vector<User> users
 * @return phone.PhoneCall
 */

final class PhoneCall extends Instance {
	public function request(object $phone_call,array $users) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xec82e140);
		$writer->write($phone_call->read());
		$writer->tgwriteVector($users,'User');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['phone_call'] = $reader->tgreadObject();
		$result['users'] = $reader->tgreadVector('User');
		return new self($result);
	}
}

?>