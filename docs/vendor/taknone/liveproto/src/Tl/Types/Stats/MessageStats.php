<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Stats;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param statsgraph views_graph statsgraph reactions_by_emotion_graph
 * @return stats.MessageStats
 */

final class MessageStats extends Instance {
	public function request(object $views_graph,object $reactions_by_emotion_graph) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x7fe91c14);
		$writer->write($views_graph->read());
		$writer->write($reactions_by_emotion_graph->read());
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['views_graph'] = $reader->tgreadObject();
		$result['reactions_by_emotion_graph'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>