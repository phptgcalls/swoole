<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Help;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string message Vector<MessageEntity> entities string author int date
 * @return help.UserInfo
 */

final class UserInfo extends Instance {
	public function request(string $message,array $entities,string $author,int $date) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x1eb3758);
		$writer->tgwriteBytes($message);
		$writer->tgwriteVector($entities,'MessageEntity');
		$writer->tgwriteBytes($author);
		$writer->writeInt($date);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['message'] = $reader->tgreadBytes();
		$result['entities'] = $reader->tgreadVector('MessageEntity');
		$result['author'] = $reader->tgreadBytes();
		$result['date'] = $reader->readInt();
		return new self($result);
	}
}

?>