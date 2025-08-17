<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param long query_id long user_id string connection_id message message long chat_instance message reply_to_message bytes data
 * @return Update
 */

final class UpdateBusinessBotCallbackQuery extends Instance {
	public function request(int $query_id,int $user_id,string $connection_id,object $message,int $chat_instance,? object $reply_to_message = null,? string $data = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x1ea2fda7);
		$flags = 0;
		$flags |= is_null($reply_to_message) ? 0 : (1 << 2);
		$flags |= is_null($data) ? 0 : (1 << 0);
		$writer->writeInt($flags);
		$writer->writeLong($query_id);
		$writer->writeLong($user_id);
		$writer->tgwriteBytes($connection_id);
		$writer->write($message->read());
		if(is_null($reply_to_message) === false):
			$writer->write($reply_to_message->read());
		endif;
		$writer->writeLong($chat_instance);
		if(is_null($data) === false):
			$writer->tgwriteBytes($data);
		endif;
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		$result['query_id'] = $reader->readLong();
		$result['user_id'] = $reader->readLong();
		$result['connection_id'] = $reader->tgreadBytes();
		$result['message'] = $reader->tgreadObject();
		if($flags & (1 << 2)):
			$result['reply_to_message'] = $reader->tgreadObject();
		else:
			$result['reply_to_message'] = null;
		endif;
		$result['chat_instance'] = $reader->readLong();
		if($flags & (1 << 0)):
			$result['data'] = $reader->tgreadBytes();
		else:
			$result['data'] = null;
		endif;
		return new self($result);
	}
}

?>