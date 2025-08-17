<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Help;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputuser user_id string message Vector<MessageEntity> entities
 * @return help.UserInfo
 */

final class EditUserInfo extends Instance {
	public function request(object $user_id,string $message,array $entities) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x66b91b70);
		$writer->write($user_id->read());
		$writer->tgwriteBytes($message);
		$writer->tgwriteVector($entities,'MessageEntity');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>