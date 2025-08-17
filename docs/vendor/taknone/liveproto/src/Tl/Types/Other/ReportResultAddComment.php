<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param bytes option true optional
 * @return ReportResult
 */

final class ReportResultAddComment extends Instance {
	public function request(string $option,? true $optional = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x6f09ac31);
		$flags = 0;
		$flags |= is_null($optional) ? 0 : (1 << 0);
		$writer->writeInt($flags);
		$writer->tgwriteBytes($option);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 0)):
			$result['optional'] = true;
		else:
			$result['optional'] = false;
		endif;
		$result['option'] = $reader->tgreadBytes();
		return new self($result);
	}
}

?>