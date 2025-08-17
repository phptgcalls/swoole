<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param reaction reaction int count string title
 * @return SavedReactionTag
 */

final class SavedReactionTag extends Instance {
	public function request(object $reaction,int $count,? string $title = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xcb6ff828);
		$flags = 0;
		$flags |= is_null($title) ? 0 : (1 << 0);
		$writer->writeInt($flags);
		$writer->write($reaction->read());
		if(is_null($title) === false):
			$writer->tgwriteBytes($title);
		endif;
		$writer->writeInt($count);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		$result['reaction'] = $reader->tgreadObject();
		if($flags & (1 << 0)):
			$result['title'] = $reader->tgreadBytes();
		else:
			$result['title'] = null;
		endif;
		$result['count'] = $reader->readInt();
		return new self($result);
	}
}

?>