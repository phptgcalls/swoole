<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Messages;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputbotinlineresult result inputuser user_id Vector<InlineQueryPeerType> peer_types
 * @return messages.BotPreparedInlineMessage
 */

final class SavePreparedInlineMessage extends Instance {
	public function request(object $result,object $user_id,? array $peer_types = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xf21f7f2f);
		$flags = 0;
		$flags |= is_null($peer_types) ? 0 : (1 << 0);
		$writer->writeInt($flags);
		$writer->write($result->read());
		$writer->write($user_id->read());
		if(is_null($peer_types) === false):
			$writer->tgwriteVector($peer_types,'InlineQueryPeerType');
		endif;
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>