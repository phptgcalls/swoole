<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Messages;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param int count Vector<SearchResultsPosition> positions
 * @return messages.SearchResultsPositions
 */

final class SearchResultsPositions extends Instance {
	public function request(int $count,array $positions) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x53b22baf);
		$writer->writeInt($count);
		$writer->tgwriteVector($positions,'SearchResultsPosition');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['count'] = $reader->readInt();
		$result['positions'] = $reader->tgreadVector('SearchResultsPosition');
		return new self($result);
	}
}

?>