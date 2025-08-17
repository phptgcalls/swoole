<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string phone_prefix_rules int dc_id Vector<IpPort> ips
 * @return AccessPointRule
 */

final class AccessPointRule extends Instance {
	public function request(string $phone_prefix_rules,int $dc_id,array $ips) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x4679b65f);
		$writer->tgwriteBytes($phone_prefix_rules);
		$writer->writeInt($dc_id);
		$writer->tgwriteVector($ips,'IpPort');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['phone_prefix_rules'] = $reader->tgreadBytes();
		$result['dc_id'] = $reader->readInt();
		$result['ips'] = $reader->tgreadVector('IpPort');
		return new self($result);
	}
}

?>