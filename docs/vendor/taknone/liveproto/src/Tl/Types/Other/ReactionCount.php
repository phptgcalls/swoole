<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param reaction reaction int count int chosen_order
 * @return ReactionCount
 */

final class ReactionCount extends Instance {
	public function request(object $reaction,int $count,? int $chosen_order = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xa3d1cb80);
		$flags = 0;
		$flags |= is_null($chosen_order) ? 0 : (1 << 0);
		$writer->writeInt($flags);
		if(is_null($chosen_order) === false):
			$writer->writeInt($chosen_order);
		endif;
		$writer->write($reaction->read());
		$writer->writeInt($count);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 0)):
			$result['chosen_order'] = $reader->readInt();
		else:
			$result['chosen_order'] = null;
		endif;
		$result['reaction'] = $reader->tgreadObject();
		$result['count'] = $reader->readInt();
		return new self($result);
	}
}

?>