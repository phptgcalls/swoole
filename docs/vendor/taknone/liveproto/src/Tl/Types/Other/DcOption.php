<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param int id string ip_address int port true ipv6 true media_only true tcpo_only true cdn true static true this_port_only bytes secret
 * @return DcOption
 */

final class DcOption extends Instance {
	public function request(int $id,string $ip_address,int $port,? true $ipv6 = null,? true $media_only = null,? true $tcpo_only = null,? true $cdn = null,? true $static = null,? true $this_port_only = null,? string $secret = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x18b7a10d);
		$flags = 0;
		$flags |= is_null($ipv6) ? 0 : (1 << 0);
		$flags |= is_null($media_only) ? 0 : (1 << 1);
		$flags |= is_null($tcpo_only) ? 0 : (1 << 2);
		$flags |= is_null($cdn) ? 0 : (1 << 3);
		$flags |= is_null($static) ? 0 : (1 << 4);
		$flags |= is_null($this_port_only) ? 0 : (1 << 5);
		$flags |= is_null($secret) ? 0 : (1 << 10);
		$writer->writeInt($flags);
		$writer->writeInt($id);
		$writer->tgwriteBytes($ip_address);
		$writer->writeInt($port);
		if(is_null($secret) === false):
			$writer->tgwriteBytes($secret);
		endif;
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 0)):
			$result['ipv6'] = true;
		else:
			$result['ipv6'] = false;
		endif;
		if($flags & (1 << 1)):
			$result['media_only'] = true;
		else:
			$result['media_only'] = false;
		endif;
		if($flags & (1 << 2)):
			$result['tcpo_only'] = true;
		else:
			$result['tcpo_only'] = false;
		endif;
		if($flags & (1 << 3)):
			$result['cdn'] = true;
		else:
			$result['cdn'] = false;
		endif;
		if($flags & (1 << 4)):
			$result['static'] = true;
		else:
			$result['static'] = false;
		endif;
		if($flags & (1 << 5)):
			$result['this_port_only'] = true;
		else:
			$result['this_port_only'] = false;
		endif;
		$result['id'] = $reader->readInt();
		$result['ip_address'] = $reader->tgreadBytes();
		$result['port'] = $reader->readInt();
		if($flags & (1 << 10)):
			$result['secret'] = $reader->tgreadBytes();
		else:
			$result['secret'] = null;
		endif;
		return new self($result);
	}
}

?>