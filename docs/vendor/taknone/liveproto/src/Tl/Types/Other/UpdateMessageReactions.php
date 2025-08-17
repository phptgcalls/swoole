<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param peer peer int msg_id messagereactions reactions int top_msg_id peer saved_peer_id
 * @return Update
 */

final class UpdateMessageReactions extends Instance {
	public function request(object $peer,int $msg_id,object $reactions,? int $top_msg_id = null,? object $saved_peer_id = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x1e297bfa);
		$flags = 0;
		$flags |= is_null($top_msg_id) ? 0 : (1 << 0);
		$flags |= is_null($saved_peer_id) ? 0 : (1 << 1);
		$writer->writeInt($flags);
		$writer->write($peer->read());
		$writer->writeInt($msg_id);
		if(is_null($top_msg_id) === false):
			$writer->writeInt($top_msg_id);
		endif;
		if(is_null($saved_peer_id) === false):
			$writer->write($saved_peer_id->read());
		endif;
		$writer->write($reactions->read());
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		$result['peer'] = $reader->tgreadObject();
		$result['msg_id'] = $reader->readInt();
		if($flags & (1 << 0)):
			$result['top_msg_id'] = $reader->readInt();
		else:
			$result['top_msg_id'] = null;
		endif;
		if($flags & (1 << 1)):
			$result['saved_peer_id'] = $reader->tgreadObject();
		else:
			$result['saved_peer_id'] = null;
		endif;
		$result['reactions'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>