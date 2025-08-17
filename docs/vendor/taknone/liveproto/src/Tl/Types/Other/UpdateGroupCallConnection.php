<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param datajson params true presentation
 * @return Update
 */

final class UpdateGroupCallConnection extends Instance {
	public function request(object $params,? true $presentation = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xb783982);
		$flags = 0;
		$flags |= is_null($presentation) ? 0 : (1 << 0);
		$writer->writeInt($flags);
		$writer->write($params->read());
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 0)):
			$result['presentation'] = true;
		else:
			$result['presentation'] = false;
		endif;
		$result['params'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>