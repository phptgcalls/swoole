<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Messages;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param true pm true group string title
 * @return messages.HistoryImportParsed
 */

final class HistoryImportParsed extends Instance {
	public function request(? true $pm = null,? true $group = null,? string $title = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x5e0fb7b9);
		$flags = 0;
		$flags |= is_null($pm) ? 0 : (1 << 0);
		$flags |= is_null($group) ? 0 : (1 << 1);
		$flags |= is_null($title) ? 0 : (1 << 2);
		$writer->writeInt($flags);
		if(is_null($title) === false):
			$writer->tgwriteBytes($title);
		endif;
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 0)):
			$result['pm'] = true;
		else:
			$result['pm'] = false;
		endif;
		if($flags & (1 << 1)):
			$result['group'] = true;
		else:
			$result['group'] = false;
		endif;
		if($flags & (1 << 2)):
			$result['title'] = $reader->tgreadBytes();
		else:
			$result['title'] = null;
		endif;
		return new self($result);
	}
}

?>