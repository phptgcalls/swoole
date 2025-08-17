<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param peer peer_id int date reaction reaction true big true unread true my
 * @return MessagePeerReaction
 */

final class MessagePeerReaction extends Instance {
	public function request(object $peer_id,int $date,object $reaction,? true $big = null,? true $unread = null,? true $my = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x8c79b63c);
		$flags = 0;
		$flags |= is_null($big) ? 0 : (1 << 0);
		$flags |= is_null($unread) ? 0 : (1 << 1);
		$flags |= is_null($my) ? 0 : (1 << 2);
		$writer->writeInt($flags);
		$writer->write($peer_id->read());
		$writer->writeInt($date);
		$writer->write($reaction->read());
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 0)):
			$result['big'] = true;
		else:
			$result['big'] = false;
		endif;
		if($flags & (1 << 1)):
			$result['unread'] = true;
		else:
			$result['unread'] = false;
		endif;
		if($flags & (1 << 2)):
			$result['my'] = true;
		else:
			$result['my'] = false;
		endif;
		$result['peer_id'] = $reader->tgreadObject();
		$result['date'] = $reader->readInt();
		$result['reaction'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>