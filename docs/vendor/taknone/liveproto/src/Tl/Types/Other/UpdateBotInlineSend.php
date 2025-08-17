<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param long user_id string query string id geopoint geo inputbotinlinemessageid msg_id
 * @return Update
 */

final class UpdateBotInlineSend extends Instance {
	public function request(int $user_id,string $query,string $id,? object $geo = null,? object $msg_id = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x12f12a07);
		$flags = 0;
		$flags |= is_null($geo) ? 0 : (1 << 0);
		$flags |= is_null($msg_id) ? 0 : (1 << 1);
		$writer->writeInt($flags);
		$writer->writeLong($user_id);
		$writer->tgwriteBytes($query);
		if(is_null($geo) === false):
			$writer->write($geo->read());
		endif;
		$writer->tgwriteBytes($id);
		if(is_null($msg_id) === false):
			$writer->write($msg_id->read());
		endif;
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		$result['user_id'] = $reader->readLong();
		$result['query'] = $reader->tgreadBytes();
		if($flags & (1 << 0)):
			$result['geo'] = $reader->tgreadObject();
		else:
			$result['geo'] = null;
		endif;
		$result['id'] = $reader->tgreadBytes();
		if($flags & (1 << 1)):
			$result['msg_id'] = $reader->tgreadObject();
		else:
			$result['msg_id'] = null;
		endif;
		return new self($result);
	}
}

?>