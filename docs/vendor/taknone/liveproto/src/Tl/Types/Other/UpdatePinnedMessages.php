<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param peer peer Vector<int> messages int pts int pts_count true pinned
 * @return Update
 */

final class UpdatePinnedMessages extends Instance {
	public function request(object $peer,array $messages,int $pts,int $pts_count,? true $pinned = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xed85eab5);
		$flags = 0;
		$flags |= is_null($pinned) ? 0 : (1 << 0);
		$writer->writeInt($flags);
		$writer->write($peer->read());
		$writer->tgwriteVector($messages,'int');
		$writer->writeInt($pts);
		$writer->writeInt($pts_count);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 0)):
			$result['pinned'] = true;
		else:
			$result['pinned'] = false;
		endif;
		$result['peer'] = $reader->tgreadObject();
		$result['messages'] = $reader->tgreadVector('int');
		$result['pts'] = $reader->readInt();
		$result['pts_count'] = $reader->readInt();
		return new self($result);
	}
}

?>