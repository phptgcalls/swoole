<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param double time string type long peer jsonvalue data
 * @return InputAppEvent
 */

final class InputAppEvent extends Instance {
	public function request(float $time,string $type,int $peer,object $data) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x1d1b1245);
		$writer->writeDouble($time);
		$writer->tgwriteBytes($type);
		$writer->writeLong($peer);
		$writer->write($data->read());
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['time'] = $reader->readDouble();
		$result['type'] = $reader->tgreadBytes();
		$result['peer'] = $reader->readLong();
		$result['data'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>