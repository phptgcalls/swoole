<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Phone;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputphonecall peer int duration phonecalldiscardreason reason long connection_id true video
 * @return Updates
 */

final class DiscardCall extends Instance {
	public function request(object $peer,int $duration,object $reason,int $connection_id,? true $video = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xb2cbc1c0);
		$flags = 0;
		$flags |= is_null($video) ? 0 : (1 << 0);
		$writer->writeInt($flags);
		$writer->write($peer->read());
		$writer->writeInt($duration);
		$writer->write($reason->read());
		$writer->writeLong($connection_id);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>