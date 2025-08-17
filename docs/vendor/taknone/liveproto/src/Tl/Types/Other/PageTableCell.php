<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param true header true align_center true align_right true valign_middle true valign_bottom richtext text int colspan int rowspan
 * @return PageTableCell
 */

final class PageTableCell extends Instance {
	public function request(? true $header = null,? true $align_center = null,? true $align_right = null,? true $valign_middle = null,? true $valign_bottom = null,? object $text = null,? int $colspan = null,? int $rowspan = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x34566b6a);
		$flags = 0;
		$flags |= is_null($header) ? 0 : (1 << 0);
		$flags |= is_null($align_center) ? 0 : (1 << 3);
		$flags |= is_null($align_right) ? 0 : (1 << 4);
		$flags |= is_null($valign_middle) ? 0 : (1 << 5);
		$flags |= is_null($valign_bottom) ? 0 : (1 << 6);
		$flags |= is_null($text) ? 0 : (1 << 7);
		$flags |= is_null($colspan) ? 0 : (1 << 1);
		$flags |= is_null($rowspan) ? 0 : (1 << 2);
		$writer->writeInt($flags);
		if(is_null($text) === false):
			$writer->write($text->read());
		endif;
		if(is_null($colspan) === false):
			$writer->writeInt($colspan);
		endif;
		if(is_null($rowspan) === false):
			$writer->writeInt($rowspan);
		endif;
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 0)):
			$result['header'] = true;
		else:
			$result['header'] = false;
		endif;
		if($flags & (1 << 3)):
			$result['align_center'] = true;
		else:
			$result['align_center'] = false;
		endif;
		if($flags & (1 << 4)):
			$result['align_right'] = true;
		else:
			$result['align_right'] = false;
		endif;
		if($flags & (1 << 5)):
			$result['valign_middle'] = true;
		else:
			$result['valign_middle'] = false;
		endif;
		if($flags & (1 << 6)):
			$result['valign_bottom'] = true;
		else:
			$result['valign_bottom'] = false;
		endif;
		if($flags & (1 << 7)):
			$result['text'] = $reader->tgreadObject();
		else:
			$result['text'] = null;
		endif;
		if($flags & (1 << 1)):
			$result['colspan'] = $reader->readInt();
		else:
			$result['colspan'] = null;
		endif;
		if($flags & (1 << 2)):
			$result['rowspan'] = $reader->readInt();
		else:
			$result['rowspan'] = null;
		endif;
		return new self($result);
	}
}

?>