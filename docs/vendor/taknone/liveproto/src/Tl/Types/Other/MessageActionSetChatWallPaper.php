<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param wallpaper wallpaper true same true for_both
 * @return MessageAction
 */

final class MessageActionSetChatWallPaper extends Instance {
	public function request(object $wallpaper,? true $same = null,? true $for_both = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x5060a3f4);
		$flags = 0;
		$flags |= is_null($same) ? 0 : (1 << 0);
		$flags |= is_null($for_both) ? 0 : (1 << 1);
		$writer->writeInt($flags);
		$writer->write($wallpaper->read());
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 0)):
			$result['same'] = true;
		else:
			$result['same'] = false;
		endif;
		if($flags & (1 << 1)):
			$result['for_both'] = true;
		else:
			$result['for_both'] = false;
		endif;
		$result['wallpaper'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>