<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param int count true top true my true anonymous peer peer_id
 * @return MessageReactor
 */

final class MessageReactor extends Instance {
	public function request(int $count,? true $top = null,? true $my = null,? true $anonymous = null,? object $peer_id = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x4ba3a95a);
		$flags = 0;
		$flags |= is_null($top) ? 0 : (1 << 0);
		$flags |= is_null($my) ? 0 : (1 << 1);
		$flags |= is_null($anonymous) ? 0 : (1 << 2);
		$flags |= is_null($peer_id) ? 0 : (1 << 3);
		$writer->writeInt($flags);
		if(is_null($peer_id) === false):
			$writer->write($peer_id->read());
		endif;
		$writer->writeInt($count);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 0)):
			$result['top'] = true;
		else:
			$result['top'] = false;
		endif;
		if($flags & (1 << 1)):
			$result['my'] = true;
		else:
			$result['my'] = false;
		endif;
		if($flags & (1 << 2)):
			$result['anonymous'] = true;
		else:
			$result['anonymous'] = false;
		endif;
		if($flags & (1 << 3)):
			$result['peer_id'] = $reader->tgreadObject();
		else:
			$result['peer_id'] = null;
		endif;
		$result['count'] = $reader->readInt();
		return new self($result);
	}
}

?>