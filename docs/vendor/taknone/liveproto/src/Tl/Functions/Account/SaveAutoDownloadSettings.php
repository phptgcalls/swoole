<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Account;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param autodownloadsettings settings true low true high
 * @return Bool
 */

final class SaveAutoDownloadSettings extends Instance {
	public function request(object $settings,? true $low = null,? true $high = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x76f36233);
		$flags = 0;
		$flags |= is_null($low) ? 0 : (1 << 0);
		$flags |= is_null($high) ? 0 : (1 << 1);
		$writer->writeInt($flags);
		$writer->write($settings->read());
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>