<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param long query_id long user_id inputbotinlinemessageid msg_id long chat_instance bytes data string game_short_name
 * @return Update
 */

final class UpdateInlineBotCallbackQuery extends Instance {
	public function request(int $query_id,int $user_id,object $msg_id,int $chat_instance,? string $data = null,? string $game_short_name = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x691e9052);
		$flags = 0;
		$flags |= is_null($data) ? 0 : (1 << 0);
		$flags |= is_null($game_short_name) ? 0 : (1 << 1);
		$writer->writeInt($flags);
		$writer->writeLong($query_id);
		$writer->writeLong($user_id);
		$writer->write($msg_id->read());
		$writer->writeLong($chat_instance);
		if(is_null($data) === false):
			$writer->tgwriteBytes($data);
		endif;
		if(is_null($game_short_name) === false):
			$writer->tgwriteBytes($game_short_name);
		endif;
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		$result['query_id'] = $reader->readLong();
		$result['user_id'] = $reader->readLong();
		$result['msg_id'] = $reader->tgreadObject();
		$result['chat_instance'] = $reader->readLong();
		if($flags & (1 << 0)):
			$result['data'] = $reader->tgreadBytes();
		else:
			$result['data'] = null;
		endif;
		if($flags & (1 << 1)):
			$result['game_short_name'] = $reader->tgreadBytes();
		else:
			$result['game_short_name'] = null;
		endif;
		return new self($result);
	}
}

?>